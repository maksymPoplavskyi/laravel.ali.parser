<?php


namespace App\Repositories;


use App\Models\ProductLocalization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductLocalizationRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return ProductLocalization::getModel();
    }

    public function createProductLocalization($productId, $productDescription): void
    {
        $this->getModel()::create([
            'product_id' => $productId,
            'lang' => App::getLocale(),
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
