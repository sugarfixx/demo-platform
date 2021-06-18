<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 09/06/2021
 * Time: 08:56
 */

namespace App;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ContentPackageTaker extends Model
{
    use Uuids;

    protected $keyType = 'string';

    public $incrementing = false;

    public function contentPackage()
    {
        return $this->belongsTo('App\ContentPackage');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
