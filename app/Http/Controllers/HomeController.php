<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\frontend_images;
use App\Models\Post;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $page_title = "Home";
        $heading_section = json_decode(Frontend::where('data_keys', 'heading_section')->first(), true)['data_values'];
        $card_section = json_decode(Frontend::where('data_keys', 'card_section')->first(), true)['data_values'];
        $gifts_section = json_decode(Frontend::where('data_keys', 'gifts_section')->first(), true)['data_values'];
        $security_section = json_decode(Frontend::where('data_keys', 'security_section')->first(), true)['data_values'];
        $wallets_section = json_decode(Frontend::where('data_keys', 'wallets_section')->first(), true)['data_values'];
        $features_section = json_decode(Frontend::where('data_keys', 'features_section')->first(), true)['data_values'];
        $partners_section = json_decode(Frontend::where('data_keys', 'partners_section')->first(), true)['data_values'];
        $try_section = json_decode(Frontend::where('data_keys', 'try_section')->first(), true)['data_values'];
        $testimonials_section = json_decode(Frontend::where('data_keys', 'testimonials_section')->first(), true)['data_values'];
        $footer_section = json_decode(Frontend::where('data_keys', 'footer_section')->first(), true)['data_values'];
        $frontend_images = frontend_images::where('data_keys', 'home')->first();
        $faqs = json_decode(file_get_contents(resource_path('/data/home/faqs.json')));
        return view('frontend.home', compact('heading_section','page_title','card_section','gifts_section','security_section','wallets_section','features_section','partners_section','try_section','testimonials_section','footer_section','frontend_images','faqs'));
    }
    public function list()
    {
        $page_title = 'Frontend Manager';

        $heading_section = json_decode(Frontend::where('data_keys', 'heading_section')->first(), true)['data_values'];
        $card_section = json_decode(Frontend::where('data_keys', 'card_section')->first(), true)['data_values'];
        $gifts_section = json_decode(Frontend::where('data_keys', 'gifts_section')->first(), true)['data_values'];
        $security_section = json_decode(Frontend::where('data_keys', 'security_section')->first(), true)['data_values'];
        $wallets_section = json_decode(Frontend::where('data_keys', 'wallets_section')->first(), true)['data_values'];
        $features_section = json_decode(Frontend::where('data_keys', 'features_section')->first(), true)['data_values'];
        $partners_section = json_decode(Frontend::where('data_keys', 'partners_section')->first(), true)['data_values'];
        $try_section = json_decode(Frontend::where('data_keys', 'try_section')->first(), true)['data_values'];
        $testimonials_section = json_decode(Frontend::where('data_keys', 'testimonials_section')->first(), true)['data_values'];
        $footer_section = json_decode(Frontend::where('data_keys', 'footer_section')->first(), true)['data_values'];
        $heading_titles = json_decode(Frontend::where('data_keys', 'heading_titles')->first(), true)['data_values'];
        $card_titles = json_decode(Frontend::where('data_keys', 'card_titles')->first(), true)['data_values'];
        $gifts_titles = json_decode(Frontend::where('data_keys', 'gifts_titles')->first(), true)['data_values'];
        $security_titles = json_decode(Frontend::where('data_keys', 'security_titles')->first(), true)['data_values'];
        $wallets_titles = json_decode(Frontend::where('data_keys', 'wallets_titles')->first(), true)['data_values'];
        $features_titles = json_decode(Frontend::where('data_keys', 'features_titles')->first(), true)['data_values'];
        $partners_titles = json_decode(Frontend::where('data_keys', 'partners_titles')->first(), true)['data_values'];
        $testimonials_titles = json_decode(Frontend::where('data_keys', 'testimonials_titles')->first(), true)['data_values'];
        $try_titles = json_decode(Frontend::where('data_keys', 'try_titles')->first(), true)['data_values'];
        $footer_titles = json_decode(Frontend::where('data_keys', 'footer_titles')->first(), true)['data_values'];


        $i=0;
        foreach($heading_titles as $heading_title){$heading_titler[$i] = $heading_title;if($i == 7){break;}$i++;}
        foreach($card_titles as $card_title){$card_titler[$i] = $card_title;if($i == 5){break;}$i++;}
        foreach($gifts_titles as $gifts_title){$gifts_titler[$i] = $gifts_title;if($i == 8){break;}$i++;}
        foreach($security_titles as $security_title){$security_titler[$i] = $security_title;if($i == 8){break;}$i++;}
        foreach($wallets_titles as $wallets_title){$wallets_titler[$i] = $wallets_title;if($i == 7){break;}$i++;}
        foreach($features_titles as $features_title){$features_titler[$i] = $features_title;if($i == 2){break;}$i++;}
        foreach($partners_titles as $partners_title){$partners_titler[$i] = $partners_title;if($i == 2){break;}$i++;}
        foreach($testimonials_titles as $testimonials_title){$testimonials_titler[$i] = $testimonials_title;if($i == 2){break;}$i++;}
        foreach($try_titles as $try_title){$try_titler[$i] = $try_title;if($i == 4){break;}$i++;}
        foreach($footer_titles as $footer_title){$footer_titler[$i] = $footer_title;if($i == 4){break;}$i++;}

        $frontend_images = frontend_images::where('data_keys', 'home')->first();
        return view('admin.frontend.index', compact('page_title','heading_section','card_section','gifts_section','security_section','wallets_section','features_section','partners_section','try_section','testimonials_section','footer_section','heading_titler','card_titler','gifts_titler','security_titler','wallets_titler','features_titler','partners_titler','try_titler','testimonials_titler','footer_titler','frontend_images'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $frontend_images = frontend_images::where('data_keys', 'home')->first();
        $imageid = $frontend_images;

        $heading_section = Frontend::where('data_keys', 'heading_section')->first();
        $heading = $request->heading;
        $final_text = array();
        foreach ($heading as $title => $value){$final_text = $heading;}
        $heading_section->data_values = $final_text;
        $heading_section->update();
        if ($request->has('bgimage')) {
            $bgimage = $imageid->img1;
            $heading_section->img1 = $bgimage;
            $request->bgimage->move(public_path('img/home/'), $bgimage);
        }

        if ($request->has('personimage')) {
            $personimage = $imageid->img2;
            $heading_section->img2 = $personimage;
            $request->personimage->move(public_path('img/home/'), $personimage);
        }




        $card_section = Frontend::where('data_keys', 'card_section')->first();
        $card = $request->card;
        $final_text = array();
        foreach ($card as $title => $value){$final_text = $card;}
        $card_section->data_values = $final_text;
        $card_section->update();

        $gifts_section = Frontend::where('data_keys', 'gifts_section')->first();
        $gifts = $request->gifts;
        $final_text = array();
        foreach ($gifts as $title => $value){$final_text = $gifts;}
        $gifts_section->data_values = $final_text;
        $gifts_section->update();
        if ($request->has('giftimage')) {
            $giftimage = $imageid->img3;
            $gifts_section->img3 = $giftimage;
            $request->giftimage->move(public_path('img/home/'), $giftimage);
        }

        $security_section = Frontend::where('data_keys', 'security_section')->first();
        $security = $request->security;
        $final_text = array();
        foreach ($security as $title => $value){$final_text = $security;}
        $security_section->data_values = $final_text;
        $security_section->update();
        if ($request->has('secureimage')) {
            $secureimage = $imageid->img4;
            $security_section->img4 = $secureimage;
            $request->secureimage->move(public_path('img/home/'), $secureimage);
        }
        if ($request->has('securityimage')) {
            $securityimage = $imageid->img5;
            $security_section->img5 = $securityimage;
            $request->securityimage->move(public_path('img/home/'), $securityimage);
        }

        $wallets_section = Frontend::where('data_keys', 'wallets_section')->first();
        $wallets = $request->wallets;
        $final_text = array();
        foreach ($wallets as $title => $value){$final_text = $wallets;}
        $wallets_section->data_values = $final_text;
        $wallets_section->update();

        $features_section = Frontend::where('data_keys', 'features_section')->first();
        $features = $request->features;
        $final_text = array();
        foreach ($features as $title => $value){$final_text = $features;}
        $features_section->data_values = $final_text;
        $features_section->update();

        $partners_section = Frontend::where('data_keys', 'partners_section')->first();
        $partners = $request->partners;
        $final_text = array();
        foreach ($partners as $title => $value){$final_text = $partners;}
        $partners_section->data_values = $final_text;
        $partners_section->update();

        $try_section = Frontend::where('data_keys', 'try_section')->first();
        $try = $request->try;
        $final_text = array();
        foreach ($try as $title => $value){$final_text = $try;}
        $try_section->data_values = $final_text;
        $try_section->update();

        $testimonials_section = Frontend::where('data_keys', 'testimonials_section')->first();
        $testimonials = $request->testimonials;
        $final_text = array();
        foreach ($testimonials as $title => $value){$final_text = $testimonials;}
        $testimonials_section->data_values = $final_text;
        $testimonials_section->update();

        $footer_section = Frontend::where('data_keys', 'footer_section')->first();
        $footer = $request->footer;
        $final_text = array();
        foreach ($footer as $title => $value){$final_text = $footer;}
        $footer_section->data_values = $final_text;
        $footer_section->update();

        $frontend_images->update();
        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }

    public function about(Request $request)
    {
        return view('frontend.pages.about');
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }
    public function seoEdit()
    {
        $page_title = 'SEO Configuration';
        $seo = Frontend::where('data_keys', 'seo.data')->first();
        if(!$seo){
            $data_values = '{"keywords":["admin","blog"],"description":"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit","social_title":"WEBSITENAME","social_description":"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit","image":null}';
            $data_values = json_decode($data_values, true);
            $frontend = new Frontend();
            $frontend->data_keys = 'seo.data';
            $frontend->data_values = $data_values;
            $frontend->save();
        }
        return view('admin.frontend.seo', compact('page_title', 'seo'));
    }
    public function frontendContent(Request $request, $key)
    {
        $purifier = new \HTMLPurifier();
        $valInputs = $request->except('_token', 'image_input', 'key', 'status', 'type', 'id');
        foreach ($valInputs as $keyName => $input) {
            if (gettype($input) == 'array') {
                $inputContentValue[$keyName] = $input;
                continue;
            }
            $inputContentValue[$keyName] = $purifier->purify($input);
        }
        $type = $request->type;
        if (!$type) {
            abort(404);
        }
        $validation_rule = [];
        $validation_message = [];
        foreach ($request->except('_token', 'video') as $input_field => $val) {
            if ($input_field == 'has_image' && $imgJson) {
                foreach ($imgJson as $imgValKey => $imgJsonVal) {
                    $validation_rule['image_input.'.$imgValKey] = ['nullable','image','mimes:jpeg,jpg,png'];
                    $validation_message['image_input.'.$imgValKey.'.image'] = inputTitle($imgValKey).' must be an image';
                    $validation_message['image_input.'.$imgValKey.'.mimes'] = inputTitle($imgValKey).' file type not supported';
                }
                continue;
            }elseif($input_field == 'seo_image'){
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, $validation_message, ['image_input' => 'image']);
        if ($request->id) {
            $content = Frontend::findOrFail($request->id);
        } else {
            $content = Frontend::where('data_keys', $key . '.' . $request->type)->first();
            if (!$content || $request->type == 'element') {
                $content = new Frontend();
                $content->data_keys = $key . '.' . $request->type;
                $content->save();
            }
        }
        if ($type == 'data') {
            $inputContentValue['image'] = @$content->data_values->image;
            if ($request->hasFile('image_input')) {
                try {
                    $inputContentValue['image'] = uploadImage($request->image_input,imagePath()['seo']['path'], imagePath()['seo']['size'], @$content->data_values->image);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload the Image.'];
                    return back()->withNotify($notify);
                }
            }
        }else{
            if ($imgJson) {
                foreach ($imgJson as $imgKey => $imgValue) {
                    $imgData = @$request->image_input[$imgKey];
                    if (is_file($imgData)) {
                        try {
                            $inputContentValue[$imgKey] = $this->storeImage($imgJson,$type,$key,$imgData,$imgKey,@$content->data_values->$imgKey);
                        } catch (\Exception $exp) {
                            $notify[] = ['error', 'Could not upload the Image.'];
                            return back()->withNotify($notify);
                        }
                    } else if (isset($content->data_values->$imgKey)) {
                        $inputContentValue[$imgKey] = $content->data_values->$imgKey;
                    }
                }
            }
        }
        $content->data_values = $inputContentValue;
        $content->save();
        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }

}
