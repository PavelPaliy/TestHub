<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTest;
use App\Library\Services\ArrValidMaker;
use App\Library\Services\PassTest;
use App\Repositories\QuestionRepository;
use App\Repositories\TestRepository;
use Illuminate\Http\Request;
use App\Test;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;


class TestController extends Controller
{
    public function __construct(Test $test)
    {
        $this->model = new TestRepository($test);
    }
    public function tags($word)
    {
        $tags =Tag::where('title', 'like', $word.'%')->get();
        $arr = [];
        foreach ($tags as $tag)
        {
            $arr[] = $tag['title'];
        }
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
    public function index()
    {
        //
    }

    public function create(ArrValidMaker $arrValidMaker)
    {
        return view('test.create');
    }

    public function store(StoreTest $request)
    {
        $i = 1;
        $max = 0;
        while ($request->input('score' . $i)) {
            $max += $request->input('score' . $i);
            $i++;
        }
        $input = ['name' => $request->title, 'intro' => $request->intro, 'time' => $request->time, 'minScore' => $request->minScore, 'maxScore' => $max, 'user_id'=>Auth::user()->id];
        $this->model->create($input);
        $this->model->addTags($request->tags);
        $this->model->addQuestions($request);
        return redirect()->route('test.show', ['id' => $this->model->getModel()->id]);
    }


    public function show($id)
    {
        //
        $test = Test::where('id', '=', $id)->firstOrFail();
        return view('test.publish', ['test'=>$test]);
    }


    public function questions($id, Request $request, PassTest $passTest)
    {
        $test = Test::where('id', '=', $id)->firstOrFail();
        $question_number = 0;
        $info = '';
        if($request->method()=="GET"){
            $q = new QuestionRepository($test->questions[$question_number], $test);
            if($test->questions[$question_number]->type != 3) {
                $answers = $q->getAnswers();
                return view('test.pass', ['test' => $test, 'question_number' => $question_number, 'answers' => $answers, 'info'=>$info]);
            }
            else{
                return view('test.pass', ['test' => $test, 'question_number' => $question_number]);
            }
        }
        else{
            if($request->input('result')=="Следующий вопрос"){
                $passTest->save_answer_to_redis($test, $request);
                $question_number = $request->input('question_number')+1;
                $info = Redis::hGet('t' . $test->id, 'q'.$question_number);
                $q = new QuestionRepository($test->questions[$question_number], $test);
                if($test->questions[$question_number]->type != 3) {
                    $answers = $q->getAnswers();
                    return view('test.pass', ['test' => $test, 'question_number' => $question_number, 'answers' => $answers, 'info'=>$info]);
                }
                else{
                    return view('test.pass', ['test' => $test, 'question_number' => $question_number, 'info'=>$info]);
                }
            }
            elseif ($request->input('not_current_qlink'))
            {
                $passTest->save_answer_to_redis($test, $request);
                $question_number = $request->input('not_current_qlink')-1;
                $info = Redis::hGet('t' . $test->id, 'q'.$question_number);
                $q = new QuestionRepository($test->questions[$question_number], $test);
                if($test->questions[$question_number]->type != 3) {
                    $answers = $q->getAnswers();
                    return view('test.pass', ['test' => $test, 'question_number' => $question_number, 'answers' => $answers, 'info'=>$info]);
                }
                else{
                    return view('test.pass', ['test' => $test, 'question_number' => $question_number, 'info'=>$info]);
                }
            }
            else{
                $passTest->save_answer_to_redis($test, $request);
                return redirect()->route('test.result', ['id'=>$test->id]);
            }
        }

    }
    public function result($id)
    {
        $test = Test::where('id', '=', $id)->firstOrFail();
        $result = Redis::hGetAll('t' . $test->id);
        $questions = $test->questions;
        $sum=0;
        for($i =0; $i<count($questions); $i++)
        {
            if($questions[$i]->type == 1)
            {
                foreach($questions[$i]->varAnswers as $answer)
                {
                    if($answer->status==1)
                    {
                        if($answer->title == $result['q'.$i])
                        {
                            $sum+=$questions[$i]->score;
                        }
                        break;
                    }
                }
            }
            elseif ($questions[$i]->type==2)
            {
                $str = "";
                $j =0;
                foreach($questions[$i]->varAnswers as $answer)
                {
                    if($answer->status==1)
                    {
                        $str .= 'answer'.$j;
                    }
                    $j++;
                }
                $result['q'.$i] = str_replace(' ', '', $result['q'.$i]);
                if($str==$result['q'.$i]){
                    $sum+=$questions[$i]->score;
                }
            }
            else{
                if($result['q'.$i]==$questions[$i]->strAnswer->title){
                    $sum+=$questions[$i]->score;

                }
            }
        }
        return view('test.result', ['sum'=>$sum, 'test'=>$test]);
    }
    public function question($id, $number)
    {
        $test = Test::where('id', '=', $id)->firstOrFail();
        $qs = $test->questions;
        for($i=1; $i<=count($qs); $i++)
        {
            if($number==$i)
            {
                if($qs[$i]->type == 1 || $qs[$i]->type == 2)
                {
                    $arr = [];
                    for($j=0; $j<count($qs[$i]->varAnswers); $j++)
                    {
                        $arr[] = $qs[$i]->varAnswers[$j]->title;
                    }
                    $arr['type']=$qs[$i]->type;
                    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
                }
                else{
                    echo json_encode([$qs[$i]->strAnswer->title], JSON_UNESCAPED_UNICODE);
                }
                break;
            }
        }
    }
}
