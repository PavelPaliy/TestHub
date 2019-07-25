<?php


namespace App\Repositories;


use App\VarAnswer;

class VarAnswerRepository extends BaseRepository
{
    protected $model;

    public function __construct(VarAnswer $answer)
    {
        $this->model = $answer;
    }
}