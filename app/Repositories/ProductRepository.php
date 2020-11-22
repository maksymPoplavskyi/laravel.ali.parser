<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends CoreRepository
{
    public function getModel(): Model
    {
        return Product::getModel();
    }

    public function getAllProductsBaseLocale($locale)
    {
        return $this->getModel()::select(['products.*', 'product_localization.localization_name', 'product_description as description'])
            ->leftJoin('product_localization', 'products.id', '=', 'product_localization.product_id')
            ->where('localization_name', $locale)
            ->get();
    }

    public function getProductById($id, $locale): Product
    {
        return $this->getModel()::select(['products.*', 'product_localization.localization_name', 'product_description as description'])
            ->leftJoin('product_localization', 'products.id', '=', 'product_localization.product_id')
            ->where('products.id', $id)
            ->where('localization_name', $locale)
            ->first();
    }

    public function addProduct($attributes): int
    {
        return $this->getModel()::create($attributes)->id;
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
