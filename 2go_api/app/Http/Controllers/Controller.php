<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSMS($mobile, $otp){

        // create curl resource
        $ch = curl_init();

        // set url
        $mobile = str_replace('+', '', $mobile);
        $mobile = str_replace('-', '', $mobile);
        $url = 'http://62.215.226.164/fccsms_P.aspx?UID=Fcctestaccount&P=fcc@268&S=InfoText&G='.$mobile.'&M=Please%20enter%20OTP%20to%20verify%20your%202go%20account%20'.$otp;

        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        //print_r($output);exit;

        // close curl resource to free up system resources
        curl_close($ch);

        return true;
    }
}
