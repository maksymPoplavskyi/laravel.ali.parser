<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryLocalizationRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\LocalizationRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $localizationRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, LocalizationRepository $localizationRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->localizationRepository = $localizationRepository;
    }

    public function index(CategoryRequest $request, $categoryName, CategoryLocalizationRepository $categoryLocalizationRepository)
    {
        return view('category', [
            'categoryName' => $this->categoryRepository->getCategoryByName($categoryName)->categoryLocalization->where('localization_name', App::getLocale())->first()->category_name,
            'categories' => $this->getCategories($categoryLocalizationRepository),
            'products' => $this->categoryRepository->getCategoryByName($categoryName)->products()->get(),
            'productsCount' => $this->productRepository->getAll()->count(),
            'localizations' => $this->localizationRepository->getAll()
        ]);
    }
}
