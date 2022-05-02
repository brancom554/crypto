<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use App\Models\Setting;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // var_dump(config('mail'));
        $templates = EmailTemplate::orderBy('id', 'ASC')->get();
        return view('admin.settings-email', compact('templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @version 1.0.0
     * @since 1.0
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_mail_driver' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = '';
            if ($validator->errors()->has('site_mail_driver')) {
                $msg = $validator->errors()->first();
            } else {
                $msg = __('messages.nothing');
            }
            $notify[] = ['warning', $msg];
        } else {

            foreach ($this->default_data() as $value) {
                Setting::updateValue($value, $request->input($value, null));
            }
            $notify[] = ['success', 'Email Settings Updated Successfully'];
        }


        if ($request->ajax()) {
            return response()->json($notify);
        }
	    return back()->withNotify($notify);
    }

    /**
     * Show the template
     *
     */
    public function show_template(Request $request)
    {
        #email_template
        if ($request->input('get_template') == null) {
            return response()->json(['msg'=>'warning', 'message'=>__('messages.wrong')]);
        } else {
            $template = EmailTemplate::get_template($request->input('get_template'));

            if ($template) {
                return view('modals.email_template', compact('template'))->render();
            } else {
                return response()->json(['msg'=>'warning', 'message'=>__('messages.form.wrong')]);
            }
        }
    }

    /**
     * Update the template
     *
     */
    public function update_template(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'subject' => 'required|min:5|max:191',
        ]);

        if ($validator->fails()) {
            $msg = '';
            if ($validator->errors()->hasAny(['slug', 'subject'])) {
                $msg = $validator->errors()->first();
            } else {
                $msg = __('messages.form.wrong');
            }
            $notify[] = ['warning', $msg];

        } else {
            $template = EmailTemplate::where('slug', $request->input('slug'))->orWhere('id', $request->input('id'))->first();
            $template->subject = $request->input('subject');
            $template->greeting = $request->input('greeting');
            $template->message = $request->input('message');
            $template->regards = isset($request->regards) ? 'true' : 'false';
            $template->notify = isset($request->notify) ? 1 : 0;

            if ($template->save()) {
                $notify[] = ['success', 'Email Template Updated Successfully'];
            } else {
                $notify[] = ['warning', 'Email Template Update Failed'];
            }
        }


        if ($request->ajax()) {
            return response()->json($notify);
        }

	    return back()->withNotify($notify);
    }

    /**
     * Set the default data
     *
     */
    private function default_data()
    {
        $data = [
            'site_mail_driver',
            'site_mail_host' ,
            'site_mail_port' ,
            'site_mail_from_address',
            'site_mail_from_name' ,
            'site_mail_encryption',
            'site_mail_username' ,
            'site_mail_password' ,
            'site_mail_footer' ,
            'send_notification_to' ,
            'send_notification_mails' ,
        ];

        return $data;
    }
}
