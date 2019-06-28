<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $stu_status
 * @property string $stu_degree
 * @property string $stu_num
 * @property string $stu_name
 * @property int $stu_gen
 * @property string $stu_cid
 * @property string $stu_eid
 * @property string|null $stu_dorm_str
 * @property string|null $stu_fromSchool
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuDormStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuEid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuFromSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuGen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStuStatus($value)
 * @property string|null $stu_from_school
 */
class User extends Model
{
    use Notifiable;
    //指定表名 
    protected $table = 't_student'; 
    //指定主键 
    protected $primaryKey = 'id'; 
    //是否开启时间戳 
    public $timestamps = false;
    //过滤字段，只有包含的字段才能被更新 
    protected $fillable = ['stu_eid', 'stu_cid']; 
    //隐藏字段 
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
