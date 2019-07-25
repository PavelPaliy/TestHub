<?php


namespace App\Repositories;
use App\Tag;

class TagRepository extends BaseRepository
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}