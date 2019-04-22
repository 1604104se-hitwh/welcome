<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string|null $post_timestamp
 * @property string|null $post_content
 * @property int $post_send_to
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostSendTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostTimestamp($value)
 * @mixin \Eloquent
 * @property string|null $post_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post wherePostTitle($value)
 */
class Post extends Model
{
    //指定表名
    protected $table = 't_post';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;
    //设置时间戳格式为Unix
    protected $dateFormat = 'U';

    public function hasOnePostRead() {
        return $this->hasOne("PostRead", "post_id", "id");
    }
}
