<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    /**
 * App\Models\Major
 *
 * @property int $id
 * @property string $major_num
 * @property string $major_name
 * @property int $dept_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major whereDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major whereMajorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Major whereMajorNum($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Department $dept
 */
    class Major extends Model
    {
        //指定表名
        protected $table = 't_major';
        //指定主键
        protected $primaryKey = 'id';
        //是否开启时间戳
        public $timestamps = false;
        // 设置白名单
        protected $fillable = [
            'major_num',
            'major_name',
            'dept_id',
        ];

        public function dept()
        {
            return $this->belongsTo('App\Models\Department', 'dept_id', 'id');
        }
    }
