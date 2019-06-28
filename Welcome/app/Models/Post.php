<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\PostRead;

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
 * @property-read \App\Models\PostRead $hasOnePostRead
 */
class Post extends Model
{
    //指定表名
    protected $table = 't_post';
    //指定主键
    protected $primaryKey = 'id';
    //是否开启时间戳
    public $timestamps = false;

    public function hasOnePostRead() {
        return $this->hasOne("\App\Models\PostRead", "post_id", "id");
    }
}
