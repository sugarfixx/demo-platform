<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 17/06/2021
 * Time: 10:23
 */

namespace App\Http\Controllers\Resources;


use App\Http\Controllers\Controller;
use App\Tenant;

class TenantController extends Controller
{
    public function getTenant($id = null)
    {
        if ($id) {
            return response()->json(Tenant::find($id));
        } else {
            return response()->json(Tenant::all());
        }
    }
}
