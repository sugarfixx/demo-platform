<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/06/2021
 * Time: 23:41
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;

class SampleDataController extends Controller
{

    public function importUsers()
    {
        $usersJson = $this->getUsersJson();
        return response()->json(json_decode($usersJson));
    }

    public function importTenants()
    {
        $tenantsJson = $this->getTenantsJson();

        return response()->json(json_decode($tenantsJson));
    }

    public function importContents()
    {
        //
    }

    private function getUsersJson()
    {
        return Storage::disk('local')->get('users.json');
    }

    private function getTenantsJson()
    {
        return Storage::disk('local')->get('tenants.json');
    }

    private function getContentsJson()
    {
        return Storage::disk('local')->get('content_doc.json');
    }


}
