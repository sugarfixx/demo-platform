<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/06/2021
 * Time: 23:41
 */

namespace App\Http\Controllers;


use App\ContentPackage;
use App\ContentPackageTaker;
use App\Criteria;
use App\Tenant;
use App\TenantUser;
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
            return response()->json(Tenant::all());
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
        if ($tenant->save())  {
            foreach ($sampleTenant->tenantUsers as $sampleTenantUser) {
                $tenantUser = new TenantUser();
                $tenantUser->tenant_id = $tenant->id;
                $tenantUser->user_id = $sampleTenantUser->user_id;
                $tenantUser->save();
            }
            foreach ($sampleTenant->contentPackages as $sampleContentPackage) {
                $contentPackage = new ContentPackage();
                $contentPackage->id = $sampleContentPackage->id;
                $contentPackage->name = $sampleContentPackage->name;
                $contentPackage->description = "";
                $contentPackage->permission  = $sampleContentPackage->persmission;
                if ($contentPackage->save()) {
                    foreach ($sampleContentPackage->criteria as $criteriaKey => $criteriaValue) {
                        $criteria = new Criteria();
                        $criteria->content_package_id =$contentPackage->id;
                        $criteria->key = $criteriaKey;
                        $criteria->value = $criteriaValue;
                        $criteria->save();
                    }
                    foreach ($contentPackage->takers as $sampleTaker) {
                        $taker = new ContentPackageTaker();
                        $taker->content_package_id = $contentPackage->id;
                        $taker->user_id = $sampleTaker->user_id;
                        $taker->save();
                    }
                }
            }
        }
        return true;
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
