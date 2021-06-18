<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 08:49
 */

namespace App;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ContentPackage extends Model
{
    use Uuids;

    protected $keyType = 'string';

    public $incrementing = false;

    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }

    public function content()
    {
        return $this->hasMany('App\Content');
    }
}
