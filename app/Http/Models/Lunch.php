<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *     type="object",
 *     example={"name":"Lunch name","description":"Lunch 1"},
 *     @SWG\Property(type="integer", property="lunch_id"),
 *     @SWG\Property(type="string", property="description"),
 * )
 */
class Lunch extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
