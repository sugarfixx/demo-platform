<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 08/06/2021
 * Time: 07:22
 */

namespace App;


use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class ContentMeta extends Model
{
    use Uuids;

    protected $table = "content_metadatas";

    protected $keyType = 'string';

    public $incrementing = false;

    public function content()
    {
        return $this->belongsTo('App\Content');
    }
}
