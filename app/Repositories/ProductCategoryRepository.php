<?php


namespace App\Repositories;


use App\Models\ProductCategory as Model;

class ProductCategoryRepository extends CoreRepository
{

    public function getModel()
    {
        return Model::getModel();
    }

    public function makeRelationProductWithCategory($productId, $categoryId)
    {
        return $this->model::insert([
            'product_id' => $productId,
            'category_id' => $categoryId
        ]);
    }

    public function updateRelation($productId, $categoryId) :bool
    {
        return $this->model::where('product_id', $productId)
            ->update(['category_id' => $categoryId]);
    }
}
