<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class CategoryController extends Controller
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(CategoryRequest $request, $categoryName)
    {
        return view('category', [
            'categoryName' => $categoryName,
            'categories' => $this->categoryRepository->getAll(),
            'products' => $this->categoryRepository->getCategoryByName($categoryName)->products()->get(),
            'productsCount' => $this->productRepository->getAll()->count()
        ]);
    }
}
