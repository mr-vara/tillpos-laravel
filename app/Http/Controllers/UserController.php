<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class UserController extends Controller
{
    /**
     * Get the authenticated User.
     * 
     * @param Illuminate\Http\Request $request
     * @return string
     */
    public function me(Request $request) {
        return response()->json(auth()->user());
    }

    /**
     * Update logged in user details.
     * 
     * @param Illuminate\Http\Request $request
     * @return object $user
     */
    public function updateUser(Request $request)
    {
        // Unset email from request as it's need extra validation.
        if (request('email')) {
            unset($request['email']);
        }
        $user = parent::updateOne(auth()->id());

        return $user;
    }
}
