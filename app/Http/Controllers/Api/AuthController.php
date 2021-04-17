<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $this->data = $request->all();

        Auth::login($this->data);
    }
}
