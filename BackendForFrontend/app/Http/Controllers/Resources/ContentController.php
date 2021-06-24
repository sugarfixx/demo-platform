<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 24/06/2021
 * Time: 23:35
 */

namespace App\Http\Controllers\Resources;


use App\Content;
use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    public function getContent($id = null)
    {
        if ($id) {
            return response()->json(Content::with('metadata', 'contentPackages','employees' ,'users')->find($id));
        } else {
            return response()->json(Content::all());
        }
    }
}
