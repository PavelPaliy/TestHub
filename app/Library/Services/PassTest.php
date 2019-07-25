<?php


namespace App\Library\Services;
use Illuminate\Http\Request;
use App\Test;

use Illuminate\Support\Facades\Redis;

class PassTest
{
    public function save_answer_to_redis(Test $test, Request $request)
    {
        if($request->input('answer')) {
            Redis::hSet('t' . $test->id, 'q'.$request->input('question_number'), $request->input('answer'));
        }
        else{
            $i=0;
            $length = count($request->input())-2;
            $answers = '';
            foreach ($request->input() as  $key =>$el)
            {
                if($i<$length && $i>0)
                {
                    $answers = $answers.' '.$key;
                }
                $i++;
            }
            Redis::hSet('t' .$test->id, 'q'.$request->input('question_number'), $answers);

        }
    }
    public function count_results(Test $test, $results)
    {

    }
}