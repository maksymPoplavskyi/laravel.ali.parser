<?php


namespace App\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends CoreRepository
{

    public function getModel(): Model
    {
        return Category::getModel();
    }

    public function getCategoryByName($categoryName)
    {
        return $this->getModel()->where('name', $categoryName)->first();
    }

}
