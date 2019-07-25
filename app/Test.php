<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = ['name', 'intro', 'time', 'minScore', 'maxScore'];
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
