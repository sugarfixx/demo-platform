<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 09:39
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public function tenant()
    {
        $this->belongsTo('App\Tenant');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function contentPackages()
    {
        return $this->hasManyThrough('App\ContentPackage', 'App\ContentPackageUsers');
    }
}
