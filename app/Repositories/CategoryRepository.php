<?php


namespace App\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CategoryRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return Category::getModel();
    }

    public function getCategoriesBasedLocale()
    {
        return $this->getModel()::select(['categories.*', 'category_localization.value'])
            ->leftJoin('category_localization', 'category_localization.category_id', '=', 'categories.id')
            ->where('lang', App::getLocale())
            ->get();
    }

}
