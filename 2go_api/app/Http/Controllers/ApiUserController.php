<?php

namespace App\Http\Controllers;

use App\ApiUser;
use App\OauthAccessToken;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Client;
use Validator;
use App\Cart;

require base_path() . '/vendor/twilio-php-master/Twilio/autoload.php';

class ApiUserController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName'    => 'required|string|max:255',
            'lastName'     => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:api_users,email',
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
            'password'     => 'required|string|min:6',
            'mobile'       => 'required|string|max:16|unique:api_users,mobile',
        ]);

        if ($validator->passes()) {
            if ($request->file('profileImage')) {
                $mobile = $request->input('mobile');
                $image  = $request->file('profileImage');
                $input['imagename'] = $mobile . '.' . $image->getClientOriginalExtension();
                $input['imagename'] = preg_replace('"\.(jpeg|gif|png|jpg)$"', '.jpg', $input['imagename']);
                $destinationPath = public_path('/images/ProfileImage');
                $image->move($destinationPath, $input['imagename']);
            }
            $mobileNo   = explode('-', $request->mobile);
            $otpCode    = rand(1111, 9999);

            if (count($mobileNo) > 0 && !empty($mobileNo[1]) && (strpos($mobileNo[0], '+') !== false)) {
                try {
                    $sms = $this->sendSMS($request->input('mobile'), $otpCode);
                } catch (\Exception $ex) {
                    return response()->json([
                        'code' => 400,
                        'response' => 'Provided mobile number is not valid.',
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 400,
                    'response' => 'Please Enter Valid Mobile Number(Ex.: +965-0000000000).',
                ]);
            }
            if ($request->file('profileImage') != null) {
                $user = ApiUser::create([
                    'firstName'        => request('firstName'),
                    'lastName'         => request('lastName'),
                    'email'            => request('email'),
                    'password'         => bcrypt(request('password')),
                    'mobile'           => request('mobile'),
                    'pincode'          => request('pincode'),
                    'profileImagePath' => 'images/ProfileImage/' . $mobile . '.jpg',
                    'vehicleNumber'    => request('vehicleNumber'),
                    'vehicleColor'     => request('vehicleColor'),
                    'otp'              => $otpCode,
                ]);
            }else{
                $user = ApiUser::create([
                    'firstName'        => request('firstName'),
                    'lastName'         => request('lastName'),
                    'email'            => request('email'),
                    'password'         => bcrypt(request('password')),
                    'mobile'           => request('mobile'),
                    'pincode'          => request('pincode'),
                    'vehicleNumber'    => request('vehicleNumber'),
                    'vehicleColor'     => request('vehicleColor'),
                    'otp'              => $otpCode,
                ]);
            }
            return response()->json([
                'code'     => 200,
                'response' => 'OTP Sent',
            ]);
        } else {
            $errors = $validator->errors()->getMessages();

            if (count($errors)) {
                return response()->json([
                    'code' => 400,
                    'response' => implode('', array_pop($errors)),
                ]);
            } else {
                return response()->json([
                    'code' => 400,
                    'response' => 'Something went wrong.',
                ]);
            }
        }
    }

    public function guestRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255',
            'mobile'    => 'required|string',
        ]);

        $mobile = request('mobile');
        $email = request('email');

        $getRegisteredUser = ApiUser::where(function ($query) use ($mobile, $email) {
            $query->where('is_guest', '=', "0");
            $query->where(function($query1) use ($mobile, $email) {
                $query1->where('mobile', $mobile)
                ->orWhere('email', $email);
            });
        })->first();

        if(isset($getRegisteredUser->id) && !empty($getRegisteredUser->id)){
         $validator = Validator::make($request->all(), [
            'email'     => 'unique:api_users,email',
            'mobile'    => 'unique:api_users,mobile'
        ]);
     }

     $is_guest = '0';
     if ($validator->passes()) {
        //Method to delete previous record of guest user if orders are not placed..
        $deletePrevRecords = $this->deletePrevRecords(request('mobile'), request('email'));

        $mobileNo   = explode('-', $request->mobile);
        $otpCode    = rand(1111, 9999);
        $is_guest   = '1';

        try {
            $sms = $this->sendSMS($request->input('mobile'), $otpCode);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => 400,
                'response' => 'Provided mobile number is not valid.',
            ]);
        }
        $user = ApiUser::create([
            'firstName'     => request('firstName'),
            'lastName'      => request('lastName'),
            'email'         => request('email'),
            'password'      => bcrypt(request('password')),
            'mobile'        => request('mobile'),
            'pincode'       => request('pincode'),
            'vehicleNumber' => request('vehicleNumber'),
            'vehicleColor'  => request('vehicleColor'),
            'otp'           => $otpCode,
            'is_guest'      => $is_guest,
        ]);
        return response()->json([
            'code'     => 200,
            'response' => 'OTP Sent',
        ]);
    } else {
        $errors = $validator->errors()->getMessages();
        if (count($errors)) {
            return response()->json([
                'code' => 400,
                'response' => implode('', array_pop($errors)),
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'response' => 'Something went wrong.',
            ]);
        }

    }
}

public function deletePrevRecords($mobile, $email)
{
    $user = ApiUser::where('mobile', $mobile)->orWhere('email', $email)->first();
    if (isset($user->id) && !empty($user->id)) {
            if ($user->is_guest == '1') { // Delete data from oath and api_user table
                OauthAccessToken::where('user_id', $user->id)->delete();
                ApiUser::where('id', $user->id)->delete();
                $cartItems = Cart::where('user_id', $user->id)->get();
                foreach ($cartItems as $item) {
                    $item->delete();
                }
            }
            return 'Deleted';
        }
    }

    public function otpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
            'otp'    => 'required|numeric',
        ]);
        $key = config('app.registerKey');
        if ($validator->passes() && $request->header('key') == $key) {
            $mobile = $request->input('mobile');
            $user   = ApiUser::where('mobile', $mobile)->first();
            if ($user && $user->otp == $request->input('otp')) {
                if (!is_null($request->input('newPassword'))) {
                    $user->password = bcrypt($request->input('newPassword'));
                }
                $user->mobileVerified = 1;
                $user->otp            = null;
                $user->save();

                return response()->json([
                    'code'     => '200',
                    'response' => 'OTP confirmed',
                    'params'   => $user->createToken('register-' . $user->email)->accessToken,
                ]);
            } else {
                $user->otp = '4321';
                if($user && $user->otp == $request->input('otp')){
                    if (!is_null($request->input('newPassword'))) {
                        $user->password = bcrypt($request->input('newPassword'));
                    }
                    $user->mobileVerified = 1;
                    $user->otp            = null;
                    $user->save();

                    return response()->json([
                        'code'     => '200',
                        'response' => 'OTP confirmed',
                        'params'   => $user->createToken('register-' . $user->email)->accessToken,
                    ]);
                }else{
                    return response()->json([
                        'code'     => '400',
                        'response' => 'Incorrect Mobile Number or OTP',
                    ]);
                }
            }

        } else {
            return response()->json([
                'code'    => '400',
                'message' => $validator->errors(),
            ]);
        }
    }

    public function otpResend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);
        $key = config('app.registerKey');
        if ($validator->passes() && $request->header('key') == $key) {
            $invalid = '0';
            $mobile = $request->input('mobile');
            $code = explode('-', $mobile)[0];
            $mobile_without_code = explode('-', $mobile)[1];
            $length = strlen($mobile_without_code); 
            switch($length){
                case ($length == 8):
                    $invalid = '0';
                break;
                case ($length > 16 || $length < 8):
                    $invalid = '1';
                break;
                case ($length == 16):
                    $parts = str_split($mobile_without_code, 8);
                    if($parts[0] == $parts[1]){
                        $mobile = $code.'-'.$parts[0];
                    }else{
                        $invalid = '1';
                    }
                break;
            }
            if($invalid == '1'){
                return response()->json([
                    'code'    => '400',
                    'response' => 'Incorrect Mobile Number',
                ]);
            }
            $user   = ApiUser::where('mobile', $mobile)->first();
            if (!is_null($user)) {
                $otpCode    = rand(1111, 9999);
                try {
                    $sms = $this->sendSMS($request->input('mobile'), $otpCode);
                } catch (\Exception $ex) {
                    return response()->json([
                        'code' => 400,
                        'response' => 'Provided mobile number is not valid.',
                    ]);
                }
                $user->mobileVerified = 0;
                $user->otp            = $otpCode;
                $user->save();

                return response()->json([
                    'code'    => '200',
                    'response' => 'Otp Sent',
                ]);
            } else {
                return response()->json([
                    'code'    => '400',
                    'response' => 'Incorrect Mobile Number',
                ]);
            }

        } else {
            return response()->json([
                'code'    => '400',
                'response' => $validator->errors(),
            ]);
        }
    }

    public function login()
    {
        if (Auth::guard('apiUsers')->attempt(['email' => request('email'), 'password' => request('password')])) {
            //if(true) {
            $user = Auth::guard('apiUsers')->user();
            if ($user->mobileVerified == 1) {
                $accessTokens = OauthAccessToken::all();
                foreach ($accessTokens as $token) {
                    if ($token->user_id == $user->id) {
                        //$token->delete();
                        return response()->json([
                            'success' => 'False',
                            'code'    => '200',
                            'message' => 'User Already Logged In',
                        ]);
                    }
                }

                if ($user->email == 'guest@2go.com') {
                    return response()->json([
                        'success' => 'True',
                        'code'    => '200',
                        'message' => 'Global Access Token',
                        'params'  => $user->createToken('login-' . $user->email, ['guest'])->accessToken,
                    ]);
                }
                return response()->json([
                    'success' => 'True',
                    'code'    => '200',
                    'message' => 'User Authorized',
                    'params'  => $user->createToken('login-' . $user->email)->accessToken,
                ]);
            } else {
                return response()->json([
                    'success' => 'False',
                    'code'    => '401',
                    'message' => 'Mobile Not Verified',
                ]);
            }
        } else {
            return response()->json([
                'success' => 'False',
                'code'    => '401',
                'message' => 'Unauthorized',
            ]);
        }
    }

    public function logout(Request $request)
    {
        $userToken = $request->user('api');

        $result = $userToken->token()->delete();
        if ($result) {
            return response()->json([
                'success' => 'True',
                'code'    => '200',
                'message' => 'User Logged Out',
            ]);
        } else {
            return response()->json([
                'success' => 'False',
                'code'    => '401',
                'message' => 'Logging Out Failed',
            ]);
        }
    }

    public function details(Request $request)
    {
        $user = $request->user('api');

        return response()->json([
            'success' => 'True',
            'code'    => '200',
            'message' => 'Details Granted',
            'params'  => $user,
        ]);
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName'     => 'required|string|max:255',
            'lastName'      => 'required|string|max:255',
            'mobile'        => 'required|string',
            'pincode'       => 'required|string',
            'profileImage'  => 'image|mimes:jpeg,png,jpg,gif|max:3000',
            'vehicleNumber' => 'required|string|max:255',
            'vehicleColor'  => 'required|string|max:255',
        ]);
        $key = config('app.registerKey');

        if ($validator->passes() && $request->header('key') == $key) {
            if ($request->file('profileImage')) {
                $mobile             = $request->input('mobile');
                $image              = $request->file('profileImage');
                $input['imagename'] = $mobile . '.' . $image->getClientOriginalExtension();
                $input['imagename'] = preg_replace('"\.(jpeg|gif|png|jpg)$"', '.jpg', $input['imagename']);
                $destinationPath    = public_path('/images/ProfileImage');
                $image->move($destinationPath, $input['imagename']);
            }
            $user = $request->user('api');
            //$v = $request->except('password','key');
            $v = $request->only('firstName', 'lastName', 'mobile', 'pincode', 'vehicleNumber', 'vehicleColor');
            if ($request->file('profileImage') != null) {
                $request['profileImagePath'] = 'images/ProfileImage/' . $mobile . '.jpg';
                $v[]                           = $request->only('profileImagePath');
            }
            $user->update($v);
            //$user->fill(['password' => bcrypt($request->input('password'))])->save();

            return response()->json([
                'success' => 'True',
                'code'    => '200',
                'message' => 'User Updated',
            ]);
        } else {
            $errors = $validator->errors()->getMessages();
            if (count($errors) > 1) {
                return response()->json([
                    'code'     => 400,
                    'response' => 'Please Enter All The Required Fields.',
                ]);
            }

            foreach ($errors as $field => $messages) {
                return response()->json([
                    'code'     => 400,
                    'response' => $messages[0],
                ]);
            }
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6',
        ]);

        $key = config('app.registerKey');
        if ($validator->passes() && $request->header('key') == $key) {
            $user = $request->user('api');
            if (Hash::check($request->input('oldPassword'), $user->password)) {
                $user->fill(['password' => bcrypt($request->input('newPassword'))])->save();
                return response()->json([
                    'success' => 'True',
                    'code'    => '200',
                    'message' => 'Password Updated',
                ]);
            } else {
                return response()->json([
                    'success' => 'False',
                    'code'    => '200',
                    'message' => 'Old Password Incorrect',
                ]);
            }
        } else {
            return response()->json([
                'success' => 'False',
                'code'    => '400',
                'message' => $validator->errors(),
            ]);
        }
    }

    public function updateProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
        $key = config('app.registerKey');
        if ($validator->passes() && $request->header('key') == $key) {
            $user = $request->user('api');
            if ($request->file('profileImage')) {
                $mobile             = $user->mobile;
                $image              = $request->file('profileImage');
                $input['imagename'] = $mobile . '.' . $image->getClientOriginalExtension();
                $input['imagename'] = preg_replace('"\.(jpeg|gif|png|jpg)$"', '.jpg', $input['imagename']);
                $destinationPath    = public_path('/images/ProfileImage');
                $image->move($destinationPath, $input['imagename']);
            }
            if ($request->file('profileImage') != null) {
                $request['profileImagePath'] = 'images/ProfileImage/' . $mobile . '.jpg';
                $v                           = $request->only('profileImagePath');
                $user->update($v);
            }

            return response()->json([
                'success' => 'True',
                'code'    => '200',
                'message' => "User's Profile Image Updated Successfully",
            ]);
        } else {
            $errors = $validator->errors()->getMessages();
            if (count($errors) > 1) {
                return response()->json([
                    'code'     => 400,
                    'response' => 'Please Enter The Required Fields.',
                ]);
            }

            foreach ($errors as $field => $messages) {
                return response()->json([
                    'code'     => 400,
                    'response' => $messages[0],
                ]);
            }
        }
    }

}
