<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Configuration
 *
 * @property int $id
 * @property int $conf_open_ctrl
 * @property int $conf_svy_open_ctrl
 * @property int $conf_svy_strict_ctrl
 * @property int $conf_shtl_open_ctrl
 * @property int $conf_enrl_open_ctrl
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereConfEnrlOpenCtrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereConfOpenCtrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereConfShtlOpenCtrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereConfSvyOpenCtrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereConfSvyStrictCtrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Configuration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Configuration extends Model
{
    //指定表名
    protected $table = 't_configuration';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
}
