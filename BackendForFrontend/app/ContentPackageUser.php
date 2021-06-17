<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 12:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ContentPackageUser extends Model
{
    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public function tenantUser()
    {
        return $this->belongsTo('App\TenantUser');
    }

    public function contentPackage()
    {
        return $this->belongsTo('App\ContentPackage');
    }
}
