<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;


class Question extends Model
{
    use VotableTrait;

    protected $fillable = ['title', 'body']; //指定した属性しか持たない

    protected $appends = ['created_date'];


    public function user()
    { //質問はユーザに属する
        return $this->belongsTo(User::class); //1対多
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value; //タイトル属性に値を割り当てる
        $this->attributes['slug'] = Str::slug($value); //スラッグ形式に変換
    }

    // public function setBodyAttribute($value)
    // {
    //     $this->attributes['body'] = clen($value);
    // }

    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return clean($this->bodyHtml());
        // $markdown = new CommonMarkConverter(['allow_unsafe_links' => false]);
        // return $markdown->convertToHtml($this->body);
        // return \Parsedown::instance()->text($this->body);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC');;
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); //, 'question_id', 'user_id');
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function getExcerptAttribute()
    {
        return $this->excerpt(250);
    }

    public function excerpt($length)
    {
        return str_limit(strip_tags($this->bodyHtml()), $length);
    }

    private function bodyHtml()
    {
        $markdown = new CommonMarkConverter(['allow_unsafe_links' => false]);
        return $markdown->convertToHtml($this->body);
    }
}
