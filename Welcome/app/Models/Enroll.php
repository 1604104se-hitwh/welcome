<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Enroll
 *
 * @property int $id
 * @property string|null $enrl_title
 * @property string|null $enrl_info
 * @property string|null $enrl_location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll whereEnrlInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll whereEnrlLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll whereEnrlTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Enroll whereId($value)
 * @mixin \Eloquent
 */
class Enroll extends Model
{
    //指定表名
    protected $table = 't_enroll';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';
}
