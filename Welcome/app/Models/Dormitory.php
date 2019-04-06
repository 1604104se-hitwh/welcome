<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dormitory
 *
 * @property int $id
 * @property string|null $dorm_desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory whereDormDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory whereId($value)
 * @mixin \Eloquent
 */
class Dormitory extends Model
{
    //指定表名
    protected $table = 't_dormitory';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';
}
