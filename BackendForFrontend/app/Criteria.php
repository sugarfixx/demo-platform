<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 09/06/2021
 * Time: 07:17
 */

namespace App;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use Uuids;

    protected $keyType = 'string';

    public $incrementing = false;

    public function contentPackage()
    {
        return $this->belongsTo('App\ContentPackage');
    }
}
