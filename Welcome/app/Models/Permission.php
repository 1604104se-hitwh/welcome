<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property int $pms_base_section
 * @property int $pms_stu_info_section
 * @property int $pms_post_section
 * @property int $pms_svy_section
 * @property int $pms_shtl_section
 * @property int $pms_enrl_section
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsBaseSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsEnrlSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsPostSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsShtlSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsStuInfoSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsSvySection($value)
 * @mixin \Eloquent
 * @property string $pms_name
 * @property int $pms_admin_section
 * @property int $pms_reporting_section
 * @property int $pms_help_verify
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsAdminSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsHelpVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission wherePmsReportingSection($value)
 */
class Permission extends Model
{
    //指定表名
    protected $table = 't_permission';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
}
