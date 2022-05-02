<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoCurrency;

class CryptoCurrencyController extends Controller
{

    public function index()
    {
    	$page_title = "Crypto Currency List";
    	$empty_message = "No Data Found";
        $jsonString = file_get_contents(base_path('public/data/coinlist.json'));
        $cryptos = json_decode($jsonString, true);
    	return view('admin.crypto.index', compact('cryptos', 'page_title', 'empty_message'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required|max:80|unique:crypto_currencies',
    		'symbol' => 'required|unique:crypto_currencies|max:30',
    		'image' => 'required|mimes:jpeg,jpg,png,svg'
    	]);
    	$crypto = new CryptoCurrency();
    	$crypto->name = $request->name;
    	$crypto->symbol = strtoupper($request->symbol);
    	$crypto->status = $request->status ? 1 : 0;
        $path = imagePath()['cryptoCurrency']['path'];
        $size = imagePath()['cryptoCurrency']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadCoin($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $crypto->image = $filename;

        // Read File
        $jsonString = file_get_contents(base_path('public/data/coinlist.json'));
        $data = json_decode($jsonString, true);
        // Update Key
        $newID = count($data['data']) + 2;
        $data['data'][] = [
                'responsive_id' => "",
                'id' => $newID,
                'name' => $request->name,
                'image' => $crypto->image,
                'symbol' => strtoupper($request->symbol),
                'status' => $request->status ? 1 : 0];
        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/data/coinlist.json'), stripslashes($newJsonString));

        $crypto->save();
        $notify[] = ['success', 'Crypto Currency Create Successfully'];
	    return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
    	$request->validate([
    		'id' => 'required|exists:crypto_currencies,id',
    		'name' => 'required|max:80|unique:crypto_currencies,name,' . $request->id,
    		'symbol' => 'required|max:30|unique:crypto_currencies,symbol,' . $request->id,
    		'image' => 'mimes:jpeg,jpg,png,svg'
    	]);
    	$crypto = CryptoCurrency::find($request->id);
    	$crypto->name = $request->name;
    	$crypto->symbol = strtoupper($request->symbol);
    	$crypto->status = $request->status ? 1 : 0;
        $path = imagePath()['cryptoCurrency']['path'];
        $size = imagePath()['cryptoCurrency']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadCoin($request->image, $path, $size, $crypto->image);
            } catch (\Exception $exp) {
                $notify[] = ['errors', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        	$crypto->image = $filename;
        }
         // Read File
        $jsonString = file_get_contents(base_path('public/data/coinlist.json'));
        $data = json_decode($jsonString, true);
        // Update Key

        foreach ($data['data'] as $key => $entry) {
            if ($entry['id'] == $request->id) {
                $data['data'][$key]['responsive_id'] = "";
                $data['data'][$key]['name'] = $request->name;
                $data['data'][$key]['image'] = $crypto->image;
                $data['data'][$key]['symbol'] = strtoupper($request->symbol);
                $data['data'][$key]['status'] = $request->status ? 1 : 0;
            }
        }
        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/data/coinlist.json'), stripslashes($newJsonString));

        $crypto->save();
        $notify[] = ['success', 'Crypto Currency Updated Successfully'];
	    return back()->withNotify($notify);
    }
    public function delete(Request $request)
    {
    	$crypto = CryptoCurrency::find($request->id);
        // Read File
        $jsonString = file_get_contents(base_path('public/data/coinlist.json'));
        $data = json_decode($jsonString, true);
        // Delete Key
        foreach ($data['data'] as $key => $entry) {
            if ($entry['id'] == $request->id) {
                unset($data['data'][$key]);
            }
        }

        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/data/coinlist.json'), stripslashes($newJsonString));

    	$crypto->delete();
    	$notify[] = ['success', 'Coin Removed Successfully'];
	    return redirect()->route('admin.crypto.index')->withNotify($notify);
    }
}
