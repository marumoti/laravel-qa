<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Question extends Model
{
    protected $fillable = ['title','body']; //指定した属性しか持たない

    public function user(){ //質問はユーザに属する
        return $this->belongsTo(User::class); //1対多
    }

   public function setTitleAttribute($value)
   {
    $this->attributes['title'] = $value; //タイトル属性に値を割り当てる
    $this->attributes['slug'] = Str::slug($value); //スラッグ形式に変換
   }

   public function getUrlAttribute()
   {
       return route("questions.show",$this->id);
   }

   public function getCreatedDateAttribute()
   {
       return $this->created_at->diffForHumans();
   }
}
