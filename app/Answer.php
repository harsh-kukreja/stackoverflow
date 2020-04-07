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
}
