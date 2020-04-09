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


    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getBestAnswerStatusAttribute()
    {
        if ($this->id === $this->question->best_answer_id)
        {
            return 'text-success';
        }
        return 'text-dark';
    }

    public function getIsBestAttribute()
    {
        return $this->id === $this->question->best_answer_id;
    }


    /**
     * Events
     * */
    public static function boot(){
        parent::boot();
        static::created(function ($answer){
            $answer->question->increment('answers_count');
        });
        static::deleted(function ($answer){
            $answer->question->decrement('answers_count');
        });
    }
}


