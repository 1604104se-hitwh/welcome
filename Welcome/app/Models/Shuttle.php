<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shuttle
 *
 * @property int $id
 * @property int $port_id
 * @property string|null $shtl_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle wherePortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shuttle whereShtlTime($value)
 * @mixin \Eloquent
 */
class Shuttle extends Model
{
    //指定表名
    protected $table = 't_shuttle';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;

    protected $fillable = [
        'port_id','shtl_time'
    ];
}
