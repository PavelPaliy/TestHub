<?php


namespace App\Repositories;
use App\Test;
use App\Tag;
use App\Question;
use App\StrAnswer;
use App\VarAnswer;

class TestRepository extends BaseRepository
{
    protected $model;

    public function __construct(Test $test)
    {
        $this->model = $test;
    }
    public function getModel(){
        return $this->model;
    }
    public function addTags($input)
    {
        $tags=explode(', ', $input);
        $tag_arr = [];
        for($i=0;$i<count($tags); $i++)
        {
            $tag = Tag::firstOrCreate(['title'=>$tags[$i]]);
            $tag_arr[$i] = $tag->id;
        }
        $this->model->tags()->attach($tag_arr);
    }
    public function addQuestions($request){
        $i=1;
        while($request->input('typeQ'.$i))
        {
            $input = ['title'=>$request->input('title'.$i), 'type'=>$request->input('typeQ'.$i), 'score'=>$request->input('score'.$i)];
            $qr = new QuestionRepository(new Question(), $this->getModel());
            $type = $request->input('typeQ'.$i);
            $question=$qr->create($input);
            if($type == 1)
            {
                $j = 1;
                while($request->input($i.'var'.$j))
                {
                    $var_answer = new VarAnswer();
                    $var_answer->title = $request->input($i."var".$j);
                    if($request->input('answer'.$i)==$j)
                    {
                        $var_answer->status = 1;
                    }
                    else{
                        $var_answer->status = 0;
                    }
                    $question->varAnswers()->save($var_answer);
                    $j++;
                }
            }
            else if($type == 2){
                $j = 1;
                while($request->input($i.'var'.$j))
                {
                    $var_answer = new VarAnswer();
                    $var_answer->title = $request->input($i.'var'.$j);
                    if($request->input($j."answer".$i))
                    {
                        $var_answer->status = 1;
                    }
                    else{
                        $var_answer->status = 0;
                    }
                    $question->varAnswers()->save($var_answer);
                    $j++;
                }
            }
            else if($type == 3){
                $str_answer = new StrAnswer();
                $str_answer->title = $request->input('answer'.$i);
                $question->strAnswer()->save($str_answer);
            }
            $i++;
        }

    }
}