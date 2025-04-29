<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verifyEmail($id, $hash, Request $request)
    {
        $user = User::findOrFail($id);
        if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
            session()->flash('error', 'Please verify email and try again.');
        }

        if ($user->is_verified) {
            return redirect()->route('login')->with('success', 'Email verified!');
        }

        $user->update(['is_verified' => true]);
        session()->flash('success', 'Email verified successfully!, please login!');
        return redirect()->route('login');
    }
}
