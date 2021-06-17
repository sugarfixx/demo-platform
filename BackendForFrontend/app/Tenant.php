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

    protected $primaryKey = 'uuid';

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
        return $this->hasMany('App\ContentPackages');
    }
}
