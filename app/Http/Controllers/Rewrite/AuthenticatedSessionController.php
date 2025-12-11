<?php

namespace App\Http\Controllers\Rewrite;

use App\Events\UserLoginWithCookies;
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthAuthenticatedSessionController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends AuthAuthenticatedSessionController
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
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
