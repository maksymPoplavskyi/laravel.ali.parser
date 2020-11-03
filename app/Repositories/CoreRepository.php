<?php


namespace App\Repositories;


abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = $this->getModel();
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getQuantityProducts()
    {
        return $this->model::count();
    }
}
