<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\LocalizationRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /** @var ProductRepository $productRepository */
    private $productRepository;

    /** @var CategoryRepository $categoryRepository */
    private $categoryRepository;

    /** @var LocalizationRepository $localizationRepository */
    private $localizationRepository;

    /** @var CategoryService $categoryService */
    private $categoryService;

    public function __construct(ProductRepository $productRepository, LocalizationRepository $localizationRepository,
                                CategoryService $categoryService, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->localizationRepository = $localizationRepository;
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Category $category)
    {
        return view('category', [
            'categoryName' => $category->categoryLocalization->first()->value,
            'categories' => $this->categoryRepository->getCategoriesBasedLocale(),
            'products' => $this->productRepository->getAllProductsByCategoryBaseLocale($category->id),
            'productsCount' => $this->productRepository->getAll()->count(),
            'localizations' => $this->localizationRepository->getAll()
        ]);
    }
}
