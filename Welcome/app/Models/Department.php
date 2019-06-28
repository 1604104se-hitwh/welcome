<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    /**
 * App\Models\Department
 *
 * @property int $id
 * @property string $dept_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereDeptName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Department whereId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Major[] $major
 */
    class Department extends Model
    {
        //指定表名
        protected $table = 't_department';
        //指定主键
        protected $primaryKey = 'id';
        //是否开启时间戳
        public $timestamps = false;
        // 设置白名单
        protected $fillable = [
            'dept_name',
        ];

        public function major()
        {
            // 一个学院有多个专业
            return $this->hasMany('App\Models\Major', 'dept_id', 'id');
        }
    }
