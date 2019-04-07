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
 * @property string|null $dorm_name
 * @property string|null $dorm_position_x
 * @property string|null $dorm_position_y
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory whereDormName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory whereDormPositionX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Dormitory whereDormPositionY($value)
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
