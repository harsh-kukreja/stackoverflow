<?php

namespace App;

class Answer extends BaseModel
{
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }


    public static function boot(){
        parent::boot();
        static::created(function ($answer){
           $answer->question->increment('answers_count');
        });
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
