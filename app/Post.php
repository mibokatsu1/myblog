<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 初期設定
    protected $table = 'posts';
    // ブラックリスト_複数代入時に代入を許可しない属性を配列で設定
    protected $guarded = array('id');
}
