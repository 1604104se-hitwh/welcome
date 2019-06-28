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
 * @property int $id
 * @property string|null $school_info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo whereSchoolInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SysInfo whereUpdatedAt($value)
 */
class SysInfo extends Model
{
    //指定表名
    protected $table = 't_sys_info';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;

    protected $fillable = ['school_info'];
}
