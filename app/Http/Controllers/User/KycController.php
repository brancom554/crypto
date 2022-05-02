<?php

namespace App\Http\Controllers\User;

use App\Helpers\Handler;
use Illuminate\Support\Facades\Validator;
use App\Models\KYC;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\KycStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class KycController extends Controller
{
    // Enable recaptcha to the public form

    private $supported_ext = ['jpeg', 'jpg', 'png', 'pdf'];

    public function __construct()
    {
        if (get_setting('kyc_before_email') == '1' && !auth()->guest()) {
            return $this->middleware('verified')->except(['index']);
        }
    }

    /**
     * Show the kyc status
     *
     * @return \Illuminate\Http\Response
     * @version 1.0.0
     * @since 1.0
     * @return void
     */
    public function index()
    {
        $user = Auth::user();
        $user_kyc = KYC::where('userId', $user->id)->first();

        return view('user.kyc.kyc', compact('user_kyc'));
    }

    /**
     * Show the kyc status
     *
     * @return \Illuminate\Http\Response
     * @version 1.0.0
     * @since 1.0
     * @return void
     */
    public function view()
    {
        $user = Auth::user();
        $kyc = KYC::where('userId', $user->id)->first();

        return view('user.kyc.kyc_details', compact('kyc'));
    }

    /**
     * Show the KYC Images
     *
     * @return \Illuminate\Http\Response
     * @version 1.0.1
     * @since 1.0
     * @return void
     */
    public function get_documents($id, $doc)
    {
        if(Auth::user()->id != KYC::FindOrFail($id)->userId){
            return abort(401);
        }

        $filename = KYC::FindOrFail($id)->document;

        if ($doc == 2) {
            $filename = KYC::FindOrFail($id)->document2;
        }
        if ($doc == 3) {
            $filename = KYC::FindOrFail($id)->document3;
        }
        if ($filename !== null) {
            if (str_contains($filename, ".env") || str_contains($filename, "../") || str_contains($filename, "/..") || !str_contains($filename, "kyc-files/")) {
                abort(404);
            }

            if (!valid_kyc_file_ext($filename, $this->supported_ext)) {
                abort(404);
            }

            $path = storage_path('app/' . $filename);
            if (!file_exists($path)) {
                abort(404);
            }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response($file, 200)->header("Content-Type", $type);

            return $response;
        } else {
            return abort(404);
        }
    }

    /**
     * Show the kyc application
     *
     * @return \Illuminate\Http\Response
     * @version 1.0.0
     * @since 1.0
     * @return void
     */
    public function application()
    {
        if (isset(Auth::user()->kyc_info->status)) {
            if (Auth::user()->kyc_info->status == 'pending') {
                return redirect()->route('user.kyc')->withNotify(['info' => __('messages.kyc.wait')]);
            }
        }
        $countries = Handler::getCountries();
        $user_kyc = Auth::user()->kyc_info;
        if ($user_kyc == null) {
            $user_kyc = new KYC();
        }
        $title = KYC::documents();

        return view('user.kyc.kyc_application', compact('user_kyc', 'countries', 'title'));
    }

    /**
     * Submit the kyc form
     *
     * @return \Illuminate\Http\Response
     * @version 1.1
     * @since 1.0
     * @return void
     */
    public function submit(Request $request)
    {
        $type = $request->documentType;
        Validator::make($request->all(), KYC::rules(), [
            'document_one.required' => __('messages.kyc.forms.document', ['NAME' => KYC::documents($type ?? 'Document')]),
            'document_two.required' => __('messages.kyc.forms.document', ['NAME' => __('National ID Card Back-Side')]),
            'document_image_hand.required' => __('messages.kyc.forms.document', ['NAME' => __('Document on Hand')]),
        ]);

            $user = Auth::user();
            $firstname = strip_tags($request->input('first_name'));
            $lastname = strip_tags($request->input('last_name'));
            $kyc_submit = new KYC();
            $kyc_submit->userId = $user->id;
            $kyc_submit->firstName = $firstname;
            $kyc_submit->lastName = $lastname;
            $kyc_submit->email = $user->email;
            $kyc_submit->phone = strip_tags($request->input('phone'));
            $kyc_submit->dob = $request->input('dob');
            $kyc_submit->gender = strip_tags($request->input('gender'));
            $kyc_submit->telegram = strip_tags($request->input('telegram'));

            $kyc_submit->country = strip_tags($request->input('country'));
            $kyc_submit->state = strip_tags($request->input('state'));
            $kyc_submit->city = strip_tags($request->input('city'));
            $kyc_submit->zip = strip_tags($request->input('zip'));
            $kyc_submit->address1 = strip_tags($request->input('address_1'));
            $kyc_submit->address2 = strip_tags($request->input('address_2'));
            $path = imagePath()['kyc']['path'];
            if ($request->hasFile('document_one')) {
                try {
                    $filename = uploadImage($request->document_one, $path);
                } catch (\Exception $exp) {
                    $notify[] = ['errors', 'Document 1 could not be uploaded.'];
                    return back()->withNotify($notify);
                }
                $kyc_submit->document = $filename;
            }
            if ($request->hasFile('document_two')) {
                try {
                    $document_two = uploadImage2($request->document_two, $path);
                } catch (\Exception $exp) {
                    $notify[] = ['errors', 'Document 2 could not be uploaded.'];
                    return back()->withNotify($notify);
                }
                $kyc_submit->document2 = $document_two;
            }
            if ($request->hasFile('document_image_hand')) {
                try {
                    $document_image_hand = uploadImage3($request->document_image_hand, $path);
                } catch (\Exception $exp) {
                    $notify[] = ['errors', 'Selfie could not be uploaded.'];
                    return back()->withNotify($notify);
                }
                $kyc_submit->document3 = $document_image_hand;
            }
            $kyc_submit->documentType = $request->input('documentType');
            $kyc_submit->status = 'pending';

            if ($kyc_submit->save()) {
                try{
                    $user->notify(new KycStatus($kyc_submit));
                    $notify[] = ['success', 'Documents Submitted Successfully'];
                }catch(\Exception $e){
                }
            } else {
                $notify[] = ['warning', 'Documents Submittion Failed'];
            }

	        return redirect()->route('user.home')->withNotify($notify);

    }
}
