<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Students
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students query()
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuDormStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuEid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuFromSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuGen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Students whereStuStatus($value)
 * @property string|null $stu_from_school
 */
class Students extends Model
{
    //指定表名 
    protected $table = 't_student'; 
    //指定主键 
    protected $primaryKey = 'id';
    //是否开启时间戳 
    public $timestamps = false;
    // 设置白名单
    protected $fillable =[
        'stu_status',
        'stu_degree',
        'stu_num',
        'stu_name',
        'stu_gen',
        'stu_cid',
        'stu_eid',
        'stu_dorm_str',
        'stu_from_school'
    ];
}
