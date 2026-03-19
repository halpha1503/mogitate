<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Season;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct()
    {
    }

    /**
     * 全商品を季節情報付きで取得（6件ずつページネーション）
     * @param string|null $sort 'asc' | 'desc' | null
     */
    public function getProducts(?string $sort = null): LengthAwarePaginator
    {
        $query = Product::with('seasons');

        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('price', $sort);
        }

        return $query->paginate(6)->withQueryString();
    }

    /**
     * IDで商品を1件取得（季節情報付き）
     */
    public function getProduct(int $id): Product
    {
        return Product::with('seasons')->findOrFail($id);
    }

    /**
     * 商品を新規登録する
     * @param array $data バリデーション済みデータ
     * @param UploadedFile $image
     */
    public function createProduct(array $data, UploadedFile $image): void
    {
        $filename = $image->getClientOriginalName();
        $image->storeAs('', $filename, 'public');

        $product = Product::create([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'image'       => $filename,
            'description' => $data['description'],
        ]);

        $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id');
        $product->seasons()->sync($seasonIds);
    }

    /**
     * 商品を更新する
     * @param int $id
     * @param array $data バリデーション済みデータ
     * @param UploadedFile|null $image
     */
    public function updateProduct(int $id, array $data, ?UploadedFile $image): void
    {
        $product = Product::findOrFail($id);

        // 画像が新たにアップロードされた場合のみ保存
        if ($image) {
            $filename = $image->getClientOriginalName();
            $image->storeAs('', $filename, 'public');
            $product->image = $filename;
        }

        $product->name        = $data['name'];
        $product->price       = $data['price'];
        $product->description = $data['description'];
        $product->save();

        // 中間テーブルを季節名→IDで同期
        $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id');
        $product->seasons()->sync($seasonIds);
    }

    /**
     * 商品を削除する
     */
    public function deleteProduct(int $id): void
    {
        Product::findOrFail($id)->delete();
    }

    /**
     * キーワードで商品名を部分一致検索（6件ずつページネーション）
     * @param string $keyword
     * @param string|null $sort 'asc' | 'desc' | null
     */
    public function searchProducts(string $keyword, ?string $sort = null): LengthAwarePaginator
    {
        $query = Product::with('seasons')
            ->where('name', 'like', '%' . $keyword . '%');

        if ($sort === 'asc' || $sort === 'desc') {
            $query->orderBy('price', $sort);
        }

        return $query->paginate(6)->withQueryString();
    }
}
