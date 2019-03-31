<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //指定表名 
    protected $table = 't_student'; 
    //指定主键 
    protected $primaryKey = 'id'; 
    //是否开启时间戳 
    protected $timestamps = false; 
    //设置时间戳格式为Unix 
    protected $dateFormat = 'U'; 
    //过滤字段，只有包含的字段才能被更新 
    // protected $fillable = ['title','content']; 
    //隐藏字段 
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
