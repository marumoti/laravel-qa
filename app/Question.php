<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;


class Question extends Model
{
    protected $fillable = ['title', 'body']; //指定した属性しか持たない

    public function user()
    { //質問はユーザに属する
        return $this->belongsTo(User::class); //1対多
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value; //タイトル属性に値を割り当てる
        $this->attributes['slug'] = Str::slug($value); //スラッグ形式に変換
    }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()     //質問の状態を返す
    {
        if ($this->answers > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        $markdown = new CommonMarkConverter(['allow_unsafe_links'=>false]);
        return $markdown->convertToHtml($this->body);
        // return \Parsedown::instance()->text($this->body);
    }
}
