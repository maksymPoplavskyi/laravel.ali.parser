<?php


namespace App\Repositories;


use App\Models\Category as Model;

class CategoryRepository extends CoreRepository
{

    public function getModel()
    {
        return Model::getModel();
    }

    public function getCategoryById($id)
    {
        return $this->model->find($id);
    }
}
