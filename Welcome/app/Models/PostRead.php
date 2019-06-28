<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostRead
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $post_id
 * @property int|null $stu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead whereStuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostRead whereUpdatedAt($value)
 */
class PostRead extends Model
{
    //指定表名
    protected $table = 't_post_read';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = true;
    // 设置白名单
    protected $fillable =[
        'post_id',
        'stu_id'
    ];
}
