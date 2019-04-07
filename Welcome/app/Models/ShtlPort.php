<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShtlPort
 *
 * @property int $id
 * @property string|null $port_info
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlPort newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlPort newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlPort query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlPort whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlPort wherePortInfo($value)
 * @mixin \Eloquent
 */
class ShtlPort extends Model
{
    //指定表名
    protected $table = 't_shtl_port';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';
}
