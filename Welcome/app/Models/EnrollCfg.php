<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnrollCfg
 *
 * @property int $id
 * @property int $enrl_begin_time
 * @property int $enrl_permission
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg whereEnrlBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg whereEnrlPermission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg whereId($value)
 * @mixin \Eloquent
 * @property string|null $school_info
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg whereSchoolInfo($value)
 * @property string|null $enrl_info
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollCfg whereEnrlInfo($value)
 */
class EnrollCfg extends Model
{
    //指定表名
    protected $table = 't_enroll_cfg';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
}
