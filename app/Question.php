<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['title', 'type', 'score'];
    public function test(){
        return $this->belongsTo(Test::class);
    }
    public function strAnswer(){
        return $this->hasOne(StrAnswer::class);
    }
    public function varAnswers(){
        return $this->hasMany(VarAnswer::class);
    }
}
