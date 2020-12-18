<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

class ProductRepository extends CoreRepository
{
    public function getModel(): Model
    {
        return Product::getModel();
    }

    public function getAllProductsBaseLocale(): LengthAwarePaginator
    {
        return $this->getModel()::select(['products.*', 'value'])
            ->leftJoin('product_localization', 'products.id', '=', 'product_localization.product_id')
            ->where('lang', App::getLocale())
            ->paginate(6);
    }

    public function getAllProductsByCategoryBaseLocale($categoryId): LengthAwarePaginator
    {
        return $this->getModel()::select(['products.*', 'value'])
            ->leftJoin('product_localization', 'products.id', '=', 'product_localization.product_id')
            ->where('category_id', $categoryId)
            ->where('lang', App::getLocale())
            ->paginate(6);
    }

    public function getProduct($product): Product
    {
        return $product->select(['products.*', 'value'])
            ->leftJoin('product_localization', 'products.id', '=', 'product_localization.product_id')
            ->where('products.id', $product->id)
            ->where('lang', App::getLocale())
            ->first();
    }

    public function addProduct($attributes): int
    {
        return $this->getModel()::create([
            'category_id' => $attributes->category_id,
            'old_price' => $attributes->old_price,
            'sales' => $attributes->sales,
            'img_url' => $attributes->img_url,
            'order_count' => $attributes->order_count,
            'stock_availability' => $attributes->stock_availability,
        ])->id;
    }

    public function updateProduct($id, $attributes): bool
    {
        return $this->getModel()::where('id', $id)
            ->update($attributes);
    }

    public function deleteProduct($id): bool
    {
        return $this->getModel()::where('id', $id)->delete();
    }
}
