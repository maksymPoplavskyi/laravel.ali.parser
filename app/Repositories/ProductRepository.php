<?php


namespace App\Repositories;


use App\Models\Product as Model;

class ProductRepository extends CoreRepository
{
    public function getModel()
    {
        return Model::class;
    }

    public function getProductById($id)
    {
        return $this->model::find($id);
    }
}
