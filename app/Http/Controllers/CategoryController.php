<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private $products_sum;
    private $categories_count;

    public function __construct(CategoryService $service)
    {
        $this->products_sum = app(ProductRepository::class)->getQuantityProducts();

        $categories = app(CategoryRepository::class)->getAll();
        $this->categories_count = $service->makeQuantityProductOfCategory($categories);
    }

    public function index($category_name)
    {
        $products = app(ProductRepository::class)->getAllProductsByCategory($category_name);

        return view('category', [
            'category_name' => $category_name,
            'products' => $products,
            'categories_count' => $this->categories_count,
            'products_sum' => $this->products_sum]);
    }
}
