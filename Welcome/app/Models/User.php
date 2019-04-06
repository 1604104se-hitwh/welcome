<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    use Notifiable;
    //指定表名 
    protected $table = 't_student'; 
    //指定主键 
    protected $primaryKey = 'id'; 
    //是否开启时间戳 
    public $timestamps = false; 
    //设置时间戳格式为Unix 
    protected $dateFormat = 'U'; 
    //过滤字段，只有包含的字段才能被更新 
    protected $fillable = ['stu_eid', 'stu_cid']; 
    //隐藏字段 
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
