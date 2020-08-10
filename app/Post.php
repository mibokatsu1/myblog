<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use cebe\markdown\Markdown as Markdown;

class Post extends Model
{
    // 初期設定
    protected $table = 'posts';
    // ブラックリスト_複数代入時に代入を許可しない属性を配列で設定
    protected $guarded = array('id');

    // belongsTo結合(主テーブル <- 従テーブル)
    public function user() {
        return $this->belongsTo('App\User');
    }

    // formのmarkdownをパースする
    // public function parse()
    // {
    //     $parser = new Markdown();

    //     return $parser->parse($this->message);
    // }

    // public function getMarkdownBodyAttribute()
    // {
    //     return $this->parse();
    // }
}