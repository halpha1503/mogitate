<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct()
    {
    }

    /**
     * 全商品を季節情報付きで取得（6件ずつページネーション）
     */
    public function getProducts(): LengthAwarePaginator
    {
        return Product::with('seasons')->paginate(6);
    }
}
