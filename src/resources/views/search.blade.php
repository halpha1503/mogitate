@extends('layouts.base')

@section('tab-title')
    検索結果 | mogitate
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="index">
        <div class="products-header">
            <h1 class="products-header__title">"{{ $keyword }}"の商品一覧</h1>
        </div>

        <div class="products-content">
            <aside class="index__sidebar">
                <form action="/products/search" method="GET" onsubmit="return this.keyword.value.trim() !== ''">
                    <input class="sidebar__search-input" type="text" name="keyword" value="{{ $keyword }}" placeholder="">
                    <button class="sidebar__search-btn" type="submit">検索</button>
                </form>

                <form action="/products/search" method="GET">
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    <p class="sidebar__sort-label">価格順で表示</p>
                    <select class="sidebar__sort-select" name="sort" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" @selected($sort === 'asc')>低い順に表示</option>
                        <option value="desc" @selected($sort === 'desc')>高い順に表示</option>
                    </select>
                    @if ($sort === 'asc' || $sort === 'desc')
                        <span class="sidebar__sort-tag">
                            {{ $sort === 'asc' ? '低い順に表示' : '高い順に表示' }}
                            <a class="sidebar__sort-tag-remove" href="/products/search?keyword={{ $keyword }}">×</a>
                        </span>
                    @endif
                </form>
            </aside>

            <div class="index__main">
                <div class="index__products">
                    @foreach ($products as $product)
                        <a class="product-card" href="/products/detail/{{ $product->id }}">
                            <div class="product-card__image-wrap">
                                <img class="product-card__image" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="product-card__info">
                                <span class="product-card__name">{{ $product->name }}</span>
                                <span class="product-card__price">¥{{ number_format($product->price) }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="index__pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
