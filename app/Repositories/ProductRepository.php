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

    public function getProductById($id): Product
    {
        return $this->getModel()::find($id);
    }

    public function addProduct($attributes): Product
    {
        return $this->getModel()::create($attributes);
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
