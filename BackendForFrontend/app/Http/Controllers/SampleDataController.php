<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 14/06/2021
 * Time: 23:41
 */

namespace App\Http\Controllers;


use App\ContentMeta;
use App\ContentPackage;
use App\ContentPackageTaker;
use App\Criteria;
use App\Content;
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
        $user->email = $sampleUser->email;
        $user->password = $sampleUser->password;
        $user->employer = $sampleUser->employer;
        $user->active = $sampleUser->active;
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
        if (Tenant::all()->count() > 3)  {
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
        $tenant = Tenant::where('id',$sampleTenant->id)->first();
        if (!$tenant) {
            $tenant = new Tenant();
            $tenant->id = $sampleTenant->id;
            $tenant->name = $sampleTenant->name;
            $tenant->save();
        }


        foreach ($sampleTenant->tenant_users as $sampleTenantUser) {
            $tenantUser = new TenantUser();
            $tenantUser->tenant_id = $tenant->id;
            $tenantUser->user_id = $sampleTenantUser->user_id;
            $tenantUser->save();
        }
        foreach ($sampleTenant->contentPackages as $sampleContentPackage) {
            $contentPackage = new ContentPackage();
            $contentPackage->id = $sampleContentPackage->id;
            $contentPackage->tenant_id = $tenant->id;
            $contentPackage->name = $sampleContentPackage->name;
            $contentPackage->description = "";
            $contentPackage->permission  = $sampleContentPackage->permission;
            if ($contentPackage->save()) {
                if (property_exists($sampleContentPackage,"criteria") && !empty($sampleContentPackage->criteria)) {
                    foreach ($sampleContentPackage->criteria as $key => $value) {
                        $var = get_object_vars($value);
                        $criteria = new Criteria();
                        $criteria->content_package_id =$contentPackage->id;
                        $criteria->key = key($var);
                        $criteria->value = current($var);
                        $criteria->save();
                    }
                }
                if ( property_exists($sampleContentPackage,'takers') && !empty($sampleContentPackage->takers)) {
                    foreach ($sampleContentPackage->takers as $sampleTaker) {
                        $taker = new ContentPackageTaker();
                        $taker->package_id = $contentPackage->id;
                        $taker->user_id = $sampleTaker->user_id;
                        $taker->save();
                    }
                }
            }
        }
        return true;
    }

    public function viewContents()
    {
        $contentsJson = $this->getContentsJson();
        return response()->json(json_decode($contentsJson));
    }

    public function importContents()
    {
        $contents = json_decode($this->getContentsJson())->contents;
        $storedContent = Content::all();
        if (count($storedContent) > 1) {
            foreach ($contents as $content) {

            }
        }

        return response()->json($contents);
    }

    private function createContent($sampleContent)
    {
        $content = new Content();
        $content->id = $sampleContent->id;
        $content->tenant_id = $sampleContent->tenant_id;
        $content->name = $sampleContent->name;
        $content->image = $sampleContent->imahge;
        if ($content->save()) {
            foreach ($content->metadata as $metadataKey => $metadataValue) {
                $contentMeta = new ContentMeta();
                $contentMeta->content_id = $content->contentId;
                $contentMeta->key = $metadataKey;
                $contentMeta->value = $metadataValue;
                $contentMeta->save();
            }
        }
        return response()->json(Content::with('metadata')->all());

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
