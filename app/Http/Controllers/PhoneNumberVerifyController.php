<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class PhoneNumberVerifyController extends Controller
{
    public function show(Request $request)
    {
        if($request->user()->userPhoneVerified()){
            return redirect()->route('home');
    }else{
            $username = "amirsoltani3476";
            $password = '0016745361';
            $from = "+983000505";
            $pattern_code = "uhh0qqzldd";
            $user_phone = $request->user()->phone;
            $user = User::where('phone' , $user_phone)->first();
            $code = $user -> verification_code;
            $to = array("$user_phone");
            $input_data = array("otp" => "$code");         // Random verification code
            $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
        return view('phoneverify.show');
    }
    }

    public function verify(Request $request)
    {
        if ($request->user()->verification_code !== $request->code) {
            return back()->withErrors(['msg', 'Invalid Code Please Try Again!']);
        }

        if ($request->user()->userPhoneVerified()) {
            return redirect()->route('home');
        }

        $request->user()->phoneVerifiedAt();

        return redirect()->route('home')->with('status', 'Your phone was successfully verified!');
    }


}
