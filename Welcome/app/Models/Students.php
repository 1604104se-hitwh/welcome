<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //指定表名 
    protected $table = 't_student'; 
    //指定主键 
    protected $primaryKey = 'id';
    //是否开启时间戳 
    public $timestamps = false; 
    //设置时间戳格式为Unix 
    protected $dateFormat = 'U'; 
    
}
