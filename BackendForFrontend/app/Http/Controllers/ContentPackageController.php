<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 11:31
 */

namespace App\Http\Controllers;


use App\ContentPackage;
use Illuminate\Http\Request;

class ContentPackageController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->getUser($request->bearerToken());
        $content = ContentPackage::with('content')
            ->where(['tenant' =>$user->tenant, ])
            ->get();
    }

    private function getUser($token)
    {
        //
    }

}
