<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 18/06/2021
 * Time: 12:08
 */

namespace App\Http\Controllers\Resources;


use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function getUser($id = null)
    {
        if ($id) {
            return response()->json(User::find($id));
        } else {
            return response()->json(User::all());
        }
    }

}
