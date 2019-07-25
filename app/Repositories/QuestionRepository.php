<?php


namespace App\Repositories;


use App\Question;
use App\Test;

class QuestionRepository extends BaseRepository
{
    protected $model;
    protected $test;
    public function __construct(Question $question, Test $test)
    {
        $this->model = $question;
        $this->test = $test;
    }
    public function create($input){
        $model = $this->model;
        $model->fill($input);
        $this->test->questions()->save($model);
        return $model;
    }
    public function getAnswers()
    {
        if($this->model->type == 1 || $this->model->type == 2)
        {
            $arr = [];
            for($j=0; $j<count($this->model->varAnswers); $j++)
            {
                $arr[] = $this->model->varAnswers[$j]->title;
            }
            return $arr;
        }
        else{
            return $this->model->strAnswer->title;
        }
    }
}