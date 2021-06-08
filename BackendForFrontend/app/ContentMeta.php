<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 08/06/2021
 * Time: 07:22
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ContentMeta extends Model
{
    public function content()
    {
        return $this->belongsTo('App\Content');
    }
}
