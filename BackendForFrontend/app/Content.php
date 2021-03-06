<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 08:49
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public function package()
    {
        return $this->belongsToMany('App\ContentPackage');
    }

    public function metadata()
    {
        return $this->hasMany('App\ContentMeta');
    }
}
