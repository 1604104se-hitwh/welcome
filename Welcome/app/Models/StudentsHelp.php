<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsHelp extends Model
{
    //指定表名
    protected $table = 't_student_help';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';
    // 白名单
    protected $fillable = ['student_id','verify','verify_info','files'];
}
