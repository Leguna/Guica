<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerifyController extends Controller
{

    function verifyEmailView(Request $request)
    {
        return view('auth.verify-email');
    }

    function verifyNotif(Request $request)
    {
        if ($request->user()->email_verified_at !== null) {
            return response()->json([
                "status" => true,
                "message" => "Email already verified."
            ]);
        }

        $request->user()->sendEmailVerificationNotification($request->user()->tokens());

        return response()->json([
            "status" => true,
            "message" => "Verification link sent to your email!"
        ]);
    }

    function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return response()->json([
            'status' => true,
            'message' => 'Email verified.'
        ]);
    }
}
