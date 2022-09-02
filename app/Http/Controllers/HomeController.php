<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Home page
     *
     */
    public function index(Request $request)
    {
        return view('pages.home.index');
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

        $auth = (new ApiAuthController)->login($request);

        $response = $auth->getData();
        if ($response->success) {
            return view('welcome');
        }
    }
}
