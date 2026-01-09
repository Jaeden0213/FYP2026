<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
       return Socialite::driver('google')
        ->with(['prompt' => 'select_account'])
        ->redirect(); // to google's login page

    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user(); // fetch info of your google acc, some info in the url

        $user = User::updateOrCreate(
            ['email' => $googleUser->email], //condition
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
