<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepository;

class ShopController extends Controller
{
    public function index()
    {
        $products = app(ProductRepository::class)->getAll();
        return view('shop', compact('products'));
    }

    public function show($category, $id)
    {
        $product = app(ProductRepository::class)->getProductById($id);
        return view('product', compact('product'));
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
