<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 15/06/2021
 * Time: 14:48
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return response()->json();
    }

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = $this->getOrFailUser($credentials);

    }

    private function getOrFailUser($credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if ($credentials['password'] == $user->password) {

        }
    }

}
