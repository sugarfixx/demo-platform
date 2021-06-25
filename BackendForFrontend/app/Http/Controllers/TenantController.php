<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 15/06/2021
 * Time: 14:43
 */

namespace App\Http\Controllers;


class TenantController extends Controller
{
    private $tenantId;

    private $userId;

    private $employerId;

    private $hasContentPackage = false;

    public function __construct()
    {
        //
    }

    public function index()
    {
        var_dump('hello'); exit;
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
        //
    }

    private function getContentForContentPackages()
    {
        //
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
