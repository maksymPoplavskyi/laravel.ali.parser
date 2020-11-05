<?php


namespace App\Repositories;


use App\Models\Product as Model;
use Carbon\Carbon;

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

    public function getProductWithCategory($id) :object
    {
        return $this->model::select(['products.*', 'categories.id as category_id', 'categories.name as category_name'])
            ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
            ->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->first();
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

    public function addProductThenReturnId($request)
    {
        return $this->model::insertGetId([
            'description' => $request->description,
            'old_price' => $request->old_price,
            'price' => $request->price,
            'sales' => $request->sales,
            'img_url' => $request->img_url,
            'order_count' => $request->order_count,
            'stock_availability' => $request->stock_availability,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateProduct($productId, $request)
    {
        return $this->model::where('id', $productId)
            ->update([
                'description' => $request->description,
                'old_price' => $request->old_price,
                'price' => $request->price,
                'sales' => $request->sales,
                'img_url' => $request->img_url,
                'order_count' => $request->order_count,
                'stock_availability' => $request->stock_availability
            ]);
    }
}
