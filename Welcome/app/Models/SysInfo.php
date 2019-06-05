<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SysInfo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo query()
 * @mixin \Eloquent
 */
class SysInfo extends Model
{
    //指定表名
    protected $table = 't_sys_info';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';

    protected $fillable = ['school_info'];
}
