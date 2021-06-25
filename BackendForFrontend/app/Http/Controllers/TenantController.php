<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 15/06/2021
 * Time: 14:43
 */

namespace App\Http\Controllers;


use App\Content;
use App\ContentPackage;
use App\ContentPackageTaker;
use App\Tenant;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    private $tenantId;

    private $userId;

    private $employerId;

    private $hasContentPackage = false;

    public function __construct(Request $request)
    {
        $accessData = explode('.', $request->bearerToken());
        $this->userId = $accessData[0];
        $this->tenantId = $accessData[1];
        $this->setEmployer();
        $this->setHasContentPackages();
    }

    private function setEmployer()
    {
        if (isset($this->userId)) {
            $user = User::find($this->userId);
            $this->employerId = $user->employer;
        }
    }

    private function setHasContentPackages()
    {
        if ($this->tenantId === $this->employerId) {
            $this->hasContentPackage = false;
        } else {
            $this->hasContentPackage = ContentPackageTaker::where('user_id', $this->userId)
                ->whereHas('contentPackage', function (Builder $q) {
                $q->where('tenant_id', $this->tenantId);
            })->first();
        }
    }

    public function index()
    {

        if ($this->tenantId === $this->employerId) {
            $content = $this->getContentForEmployees();
        } else {
            if ($this->hasContentPackage) {
                $content = $this->getContentForContentPackages();
            } else {
                $content = ['message' => "No content for you"];
            }
        }
        return response()->json($content);
    }

    private function getContentForEmployees()
    {
        return response()->json(Content::where('tenant_id',$this->tenantId)->get());
    }

    private function getContentForContentPackages()
    {
        $contentPackages = ContentPackage::with('criteria')
            ->where('tenant_id', $this->tenantId)
            ->whereHas('taker', function (Builder $q)  {
                $q->where('user_id', $this->userId);
            })
            ->get();
        $contentData = [];

        foreach ($contentPackages as $cp) {
            foreach ($cp->criteria as $criteria) {
                $contentData[] = Content::whereHas('metadata', function (Builder $q) use ($criteria) {
                    $q->where('key',$criteria->key)
                        ->where('value',$criteria->value);
                })->get();
            }
        }

        return $contentData;
    }

    public function show()
    {
        //
    }

    public function process()
    {
        //
    }


}
