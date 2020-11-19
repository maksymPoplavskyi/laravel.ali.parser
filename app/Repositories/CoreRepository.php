<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    protected $model;

    abstract public function getModel(): Model;

    public function getAll()
    {
        return $this->getModel()::all();
    }
}
