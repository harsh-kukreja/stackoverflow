<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Answer extends BaseModel
{
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Morphed relation
     */

    public function votes()
    {
        return $this->morphToMany(User::class,'vote')->withTimestamps();
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




    /*Using morph relation to vote a question using the vote */
    public function vote(int $vote)
    {
        $this->votes()->attach(Auth::id(),['vote'=>$vote]);
        if ($vote < 0)
        {
            $this->decrement('votes_count');
        }
        else
        {
            $this->increment('votes_count');
        }
    }

    public function updateVote(int $vote)
    {
        $this->votes()->updateExistingPivot(\auth()->id(),['vote'=>$vote]);
        if ($vote < 0)
        {
            $this->decrement('votes_count');
            /*2 times kyuki ek baar voh jo value thi uski ek baar ho and hamne bhi ek bar kiya iseleye*/
            $this->decrement('votes_count');
        }
        else
        {
            $this->increment('votes_count');
            $this->increment('votes_count');
        }
    }
}


