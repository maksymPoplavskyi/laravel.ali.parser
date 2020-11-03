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

    public function getAllProductsWithCategory()
    {
        return $this->model::select(['products.*', 'categories.name as category_name'])
            ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
            ->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
            ->get();
    }

    public function getQuantityProductOfCategory($category)
    {
        return $this->model::select(['products.*', 'categories.id as cat_id', 'categories.name as category_name'])
            ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
            ->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
            ->where('categories.id', '=', $category)
            ->count();
    }

    public function getAllProductsByCategory($category_name)
    {
        return $this->model::select(['products.*', 'categories.name as category_name'])
            ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
            ->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
            ->where('categories.name', '=', $category_name)
            ->get();
    }
}
