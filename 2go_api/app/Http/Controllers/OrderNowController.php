<?php

namespace App\Http\Controllers;

use App\Merchant;
use App\Policy;
use Illuminate\Http\Request;

class OrderNowController extends Controller
{
    public function show($id)
    {
        $flag = false;
        $request = Request::capture();
        $merchant = Merchant::where('id', $id)->first();
        if (!is_null($merchant)) {
            $totalTime = $merchant->merchantAvgTime;
            $timeToCheck = date("h:iA",strtotime(date("h:iA")." +$totalTime minutes"));
            $merchantEndTime = str_replace('-', '', substr($merchant->merchantOpenClose, strpos($merchant->merchantOpenClose, ",") + 1));
            $endTime = substr_replace($merchantEndTime, ':', (strlen($merchantEndTime) == '6') ? 2 : 1, 0);
            if(strtotime(date('Y-m-d')." ".$timeToCheck) < strtotime(date('Y-m-d')." ".$endTime)){
                $flag = true;
            }
            if ($request->hasHeader('Content-Type') == 'application/json') {    
                return response()->json([
                    'code' => '200',
                    'order_status' => $flag
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
