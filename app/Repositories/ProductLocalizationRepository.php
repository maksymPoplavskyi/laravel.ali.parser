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

    public function createProductLocalization($id, $lang, $value): void
    {
        $this->getModel()::create([
            'product_id' => $id,
            'lang' => $lang,
            'value' => $value
        ]);
    }

    public function deleteProductLocalization($productId)
    {
        $this->getModel()::where('product_id', $productId)->delete();
    }

    public function updateProductLocalization($id, $attributes)
    {
        foreach ($attributes as $locale => $content) {
            $this->getModel()::where('product_id', $id)
                ->where('lang', $locale)
                ->update(['value' => $content]);
        }
    }
}
