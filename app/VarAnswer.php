<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VarAnswer extends Model
{
    //
    protected $fillable = ['title', 'status'];
    public  function question(){
        return $this->belongsTo(Question::class);
    }
}
