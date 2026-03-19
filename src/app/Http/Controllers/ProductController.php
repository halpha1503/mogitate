<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index()
    {
        $products = $this->productService->getProducts();
        return view('index', compact('products'));
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function search()
    {
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(string $id)
    {
    }

    public function destroy(string $id)
    {
    }
}
