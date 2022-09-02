<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    /**
     * Show login page
     *
     */
    public function show(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Login method
     *
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $responseBody = $this->getResponse('login', 'POST', $request);
        if ($responseBody['success']) {
            return redirect(route('home'));
        }

        return redirect(route('login'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }
}
