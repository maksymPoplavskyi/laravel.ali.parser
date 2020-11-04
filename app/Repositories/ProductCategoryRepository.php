<?php


namespace App\Repositories;


use App\Models\ProductCategory as Model;

class ProductCategoryRepository extends CoreRepository
{

    public function getModel()
    {
        return Model::getModel();
    }

    public function makeRelationProductWithCategory($id, $categoryId)
    {
        return $this->model::insert([
            'product_id' => $id,
            'category_id' => $categoryId
        ]);
    }
}
