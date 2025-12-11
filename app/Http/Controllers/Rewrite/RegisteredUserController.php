<?php

namespace App\Http\Controllers\Rewrite;

use App\Events\UserLoginWithCookies;
use App\Http\Controllers\Auth\RegisteredUserController as AuthRegisteredUserController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends AuthRegisteredUserController
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $response = parent::store($request);

        // Custom logic for updating guest_token from cookies.
        $user = Auth::user();
        if ($user !== null) {
            $guestToken = $request->cookie('guest_token');
            event(new UserLoginWithCookies($user, $guestToken));
        }

        return $response;
    }
}
