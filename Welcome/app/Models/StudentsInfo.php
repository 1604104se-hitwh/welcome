<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudentsInfo
 *
 * @property int $id
 * @property int $student_id
 * @property int $verify
 * @property string|null $verify_info
 * @property mixed|null $files
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsInfo whereVerifyInfo($value)
 * @mixin \Eloquent
 */
class StudentsInfo extends Model
{
    //指定表名
    protected $table = 't_student_info';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;
    // 白名单
    protected $fillable = ['student_id','home_addr','phone_num','relate','nation','party'];
}
