<?php


namespace App\Repositories;


use App\Models\CategoryLocalization;
use Illuminate\Database\Eloquent\Model;

class CategoryLocalizationRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return CategoryLocalization::getModel();
    }

    public function getCategoryBasedLocale($locale)
    {
        return $this->getModel()->where('localization_name', $locale)->get();
    }
}
