<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $products = $this->productService->getProducts($sort);
        return view('index', compact('products', 'sort'));
    }

    public function create()
    {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $this->productService->createProduct(
            $request->validated(),
            $request->file('image')
        );
        return redirect('/products');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $sort = $request->input('sort');
        $products = $this->productService->searchProducts($keyword, $sort);
        return view('search', compact('products', 'keyword', 'sort'));
    }

    public function show(string $id)
    {
        $product = $this->productService->getProduct((int) $id);
        return view('detail', compact('product'));
    }

    public function edit(string $id)
    {
    }

    public function update(ProductRequest $request, string $id)
    {
        $this->productService->updateProduct(
            (int) $id,
            $request->validated(),
            $request->file('image')
        );
        return redirect('/products');
    }

    public function destroy(string $id)
    {
        $this->productService->deleteProduct((int) $id);
        return redirect('/products');
    }
}
