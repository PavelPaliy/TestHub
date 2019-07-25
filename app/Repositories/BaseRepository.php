<?php


namespace App\Repositories;


abstract class BaseRepository
{
    public function create($input){
        $model = $this->model;
        $model->fill($input);
        $model->save();
        return $model;
    }

}