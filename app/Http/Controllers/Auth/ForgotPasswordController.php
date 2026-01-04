<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(\Illuminate\Http\Request $request)
    {
        $request->validate(['email' => 'required']);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(\Illuminate\Http\Request $request)
    {
        $input = $request->input('email');

        // Check if input is email
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return $request->only('email');
        }

        // Assume it's a NIM, lookup email
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $input)->first();

        if ($mahasiswa && $mahasiswa->user) {
            return ['email' => $mahasiswa->user->email];
        }

        // Fallback (will fail to find user)
        return ['email' => $input];
    }
}
