<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 07/06/2021
 * Time: 08:49
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ContentPackage extends Model
{
    protected $primaryKey = 'uuid';

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
