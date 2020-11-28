<?php


namespace App\Repositories;


use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Model;

class ProductLocalizationRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return ProductLocalization::getModel();
    }

    public function createProductLocalization($productId, $locale, $productDescription): void
    {
        $this->getModel()::create([
            'product_id' => $productId,
            'localization_name' => $locale,
            'product_description' => $productDescription
        ]);
    }

    public function deleteProductLocalization($productId)
    {
        $this->getModel()::where('product_id', $productId)->delete();
    }

    public function updateProductLocalization($productId, $attributes)
    {
        foreach ($attributes as $locale => $content) {
            $this->getModel()::where('product_id', $productId)
                ->where('localization_name', $locale)
                ->update(['product_description' => $content]);
        }
    }
}
