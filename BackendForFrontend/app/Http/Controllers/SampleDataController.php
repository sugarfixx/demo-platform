<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/06/2021
 * Time: 23:41
 */

namespace App\Http\Controllers;


use App\Tenant;
use App\User;
use Illuminate\Support\Facades\Storage;

class SampleDataController extends Controller
{

    public function importUsers()
    {
        $usersJson = json_decode($this->getUsersJson());
        if (User::all()->count() > 0) {
            return response()->json(User::all());
        } else {
            foreach ($usersJson->users as $sampleUser){
                $this->createUser($sampleUser);
            }
            return response()->json(User::all());
        }
    }

    public function createUser($sampleUser)
    {
        $user = new User();
        $user->id = $sampleUser->id;
        $user->name = $sampleUser->name;
        $user->password = $sampleUser->password;
        $user->employer = $sampleUser->employer;
        $user->ative = $sampleUser->active;
        return $user->save();
    }

    public function viewSampleUsers()
    {
        $usersJson = $this->getUsersJson();
        return response()->json(json_decode($usersJson));
    }

    public function importTenants()
    {
        $tenantsJson = json_decode($this->getTenantsJson());
        if (Tenant::all()->count() > 0)  {
            return response()->json(Tenant::all());
        } else  {
            foreach ($tenantsJson->tenants as $sampleTenant) {
                $this->createTenant($sampleTenant);
            }
        }


    }

    public function viewSampleTenants()
    {
        $tenantsJson = $this->getTenantsJson();

        return response()->json(json_decode($tenantsJson));
    }

    private function createTenant($sampleTenant)
    {
        $tenant = new Tenant();
        $tenant->id = $sampleTenant->id;
        $tenant->name = $sampleTenant->name;
    }

    public function importContents()
    {
        $contentsJson = $this->getContentsJson();
        return response()->json(json_decode($contentsJson));
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
