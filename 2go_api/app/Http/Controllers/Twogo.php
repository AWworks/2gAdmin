<?php
/**
 * Created by PhpStorm.
 * User: anura
 * Date: 04-01-2018
 * Time: 08:25 AM
 */

namespace App\Http\Controllers;


class Twogo
{
    public function successResponse($message, $user, $tokenType)
    {
        return response()->json([
            'success' => 'True',
            'code' => '200',
            'message' => $message,
            'token' => $user->createToken($tokenType . $user->email)->accessToken,
        ]);
    }

}