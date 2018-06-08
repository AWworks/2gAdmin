<?php

namespace App\Http\Controllers;

use App\Merchant;
use Illuminate\Http\Request;

class MerchantAvailabilityController extends Controller
{
    public function show($id)
    {
        $status = 'close';
        $request = Request::capture();
        $merchant = Merchant::where('id', $id)->first();
        if (!is_null($merchant)) {

            $merchantStartTime = str_replace('-', '',explode(',', $merchant->merchantOpenClose)[0]);
            $merchantEndTime = str_replace('-', '',explode(',', $merchant->merchantOpenClose)[1]);

            $startTime = substr_replace($merchantStartTime, ':', (strlen($merchantStartTime) == '6') ? 2 : 1, 0);
            $endTime = substr_replace($merchantEndTime, ':', (strlen($merchantEndTime) == '6') ? 2 : 1, 0);
            $currTime = strtotime(now());

            if($currTime > strtotime(date('Y-m-d')." ".$startTime) && $currTime < strtotime(date('Y-m-d')." ".$endTime)){
                $status = 'open';
            }

            if ($request->hasHeader('Content-Type') == 'application/json') {    
                return response()->json([
                    'code' => '200',
                    'response' => $status,
                ]);
            }
        } else {
            return response()->json([
                'code' => '200',
                'response' => 'No data found.',
            ]);
        }
    }

}
