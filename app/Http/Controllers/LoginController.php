<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email; 
use Log;
use DB;
use GuzzleHttp\Client;
use Session;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $title="Login";
        $data=compact('title');
        return view('form')->with($data);
    }
    public function input(Request $request)
    {
        Log::info("inside input");
        Log::info($request);
        $title="Comment";
        $email = Email::where('email', $request["emailcheck"])->first();
        // $email = DB::table('email')->where('email', $request['emailcheck'])->first();

        $x=json_decode(json_encode($email), true);
        Log::info($x);
        // $data=compact('title','email');
        $data=array($title, $email);
        return view('input')->with('data',$data);
    }
    public function value(Request $request)
    {
        Log::info($request);
        Email::where('email',$request["email"])->insert([
            'input' => $request['comment'],
        ]);
        Log::info($request['comment']);
        return view('submitted');
    }
    public function comment()
    {
        $title="Thankyou for the input";
        $data=compact('title');
        return view('submitted')->with($data);
    }
    public function email_validate(Request $data){
        Log::info("inside email_validate");
        Log::info($data);
        $number = Email::where('email', $data["emailcheck"])->first();
        $userId = null;
        $content = "test product";
        $value = Email::where('email', $data["emailcheck"])->count();
        Log::info($value);
        if($value == 1){
            Log::info( response()->json(true));
            $otp = rand(1000,9999);
            $message = urlencode("Your OTP for ".$content." is ".$otp." - Happydemic");
            Log::info($number->phone);
            Log::info($message);
            $url = "http://103.16.101.52:8080/bulksms/bulksms?username=briq-happydemic&password=Happydem&type=0&dlr=1&destination=". $number->phone ."&source=HPYDMC&message=".$message."&entityid=1201159256716142013&tempid=1207161883336600190";
            $client = new \GuzzleHttp\Client(['verify' => false]);
            $response = $client->request('GET', $url);
            Session::put('artist_otp', $otp);
            Log::info(Session::get('artist_otp') );
            return response()->json(true);
        }else{
            Log::info( response()->json(false));
            return response()->json(true);
        }
    }
    public function otp_validate(Request $data){
        Log::info('initiate');
        Log::info($data);
        Log::info(Session::get('artist_otp') );
        if(Session::exists('artist_otp') && Session::get('artist_otp') == $data["otpcheck"]){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
}