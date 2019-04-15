<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShtlRecord
 *
 * @property int $id
 * @property int $port_id
 * @property int $stu_id
 * @property string|null $record_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord whereRecordTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord wherePortId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShtlRecord whereStuId($value)
 * @mixin \Eloquent
 */
class ShtlRecord extends Model
{
    //指定表名
    protected $table = 't_shtl_record';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';
}
