<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string|null $adm_name
 * @property string $adm_password
 * @property int|null $pms_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAdmName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAdmPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePmsId($value)
 * @mixin \Eloquent
 * @property int $dept_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereDeptId($value)
 */
class Admin extends Model
{
    //指定表名
    protected $table = 't_admin';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
}
