<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 15/06/2021
 * Time: 14:43
 */

namespace App\Http\Controllers;


use App\Content;
use App\Tenant;
use App\User;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    private $tenantId;

    private $userId;

    private $employerId;

    private $hasContentPackage = true;

    public function __construct(Request $request)
    {
        $accessData = explode( '.',$request->bearerToken());
        $this->userId = $accessData[0];
        $this->tenantId = $accessData[1];
        $this->setEmployer();
    }

    private function setEmployer()
    {
        if (isset($this->userId)) {
            $user = User::find($this->userId);
            $this->employerId = $user->employer;
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
        return Tenant::find($this->tenantId);
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
