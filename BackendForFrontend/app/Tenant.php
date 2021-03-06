<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 08:47
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public function content()
    {
        return $this->hasMany('App\Content');
    }

    public function users()
    {
        return $this->hasMany('App\TenantUser');
    }

    public function contentPackages()
    {
        return $this->hasMany('App\ContentPackage', 'tenant_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany('App\User','employer', 'id');
    }
}
