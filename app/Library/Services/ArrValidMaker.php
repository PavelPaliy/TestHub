<?php


namespace App\Library\Services;




class ArrValidMaker
{
    public function doArr($request)
    {
        $arr = [
            'title' => 'required|max:255',
            'time' => 'regex:/^[0-9]+$/',
            'minScore' => 'required|regex:/^[0-9]+$/',
        ];
        $i = 1;
        while(array_key_exists('typeQ'.$i, $request))
        {
            $arr['title'.$i]='required';
            $arr['score'.$i]='required|regex:/^[0-9]+$/';
            if($request['typeQ'.$i] == 1 || $request['typeQ'.$i] == 2)
            {
                $j = 1;
                while(array_key_exists($i.'var'.$j, $request))
                {
                    $arr[$i."var".$j]='required';
                    $j++;
                }
            }
            else{
                $arr['answer'.$i]='required';
            }
            $i++;
        }
        return $arr;
    }
    public function doMessages($request){
        $result = ['title.required' => 'Введите название теста!',];
        $i = 1;
        while(array_key_exists('typeQ'.$i, $request))
        {
            $result['title'.$i.'.required']='Введите '.$i.' вопрос!';
            $result['score'.$i.'.required']='Введите балы за '.$i.' вопрос!';
            if($request['typeQ'.$i] == 1 || $request['typeQ'.$i] == 2)
            {
                $j = 1;
                while(array_key_exists($i.'var'.$j, $request))
                {
                    $result[$i."var".$j.'.required']='Заполните все ответы в '.$i.'вопросе';
                    $j++;
                }
            }
            else{
                $arr['answer'.$i.'.required']='Заполните все ответы в '.$i.'вопросе';
            }
            $i++;
        }
        return $result;
    }
}