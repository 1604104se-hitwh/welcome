<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudentsHelp
 *
 * @property int $id
 * @property int $student_id
 * @property int $verify
 * @property string|null $verify_info
 * @property mixed|null $files
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentsHelp whereVerifyInfo($value)
 * @mixin \Eloquent
 */
class StudentsHelp extends Model
{
    //指定表名
    protected $table = 't_student_help';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;
    // 白名单
    protected $fillable = ['student_id','verify','verify_info','files'];
}
