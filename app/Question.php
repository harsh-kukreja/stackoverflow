<?php

namespace App;

use Illuminate\Support\Str;

class Question extends BaseModel
{
    //We dont want user as the name
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Mutator, kyu use karre kyuki meko koi toh event chahye like apne case me title tha and slug is related to slug title: 'hi lraveel' slug 'hi-lraveel' iseleye relate karle

//    The syntax is as followed abhi hamne isko call kiya iseleye apne toh apni responsibility hai dalne ki title ko
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }
}
