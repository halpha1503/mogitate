@extends('layouts.base')

@section('tab-title')
    {{ $product->name }} | mogitate
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="detail">
        <p class="detail__breadcrumb">
            <a class="detail__breadcrumb-link" href="/products">商品一覧</a>
            &gt; {{ $product->name }}
        </p>

        <form class="detail__form" action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="detail__body">
                <div class="detail__left">
                    <img class="detail__image" id="preview"
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">

                    <div class="detail__file-wrap">
                        <label class="detail__file-btn">
                            ファイルを選択
                            <input type="file" name="image" accept=".png,.jpeg,.jpg"
                                onchange="previewImage(this)">
                        </label>
                        <span class="detail__file-name" id="fileName">{{ $product->image }}</span>
                    </div>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="detail__right">
                    <div class="detail__field">
                        <p class="detail__label">商品名</p>
                        <input class="detail__input" type="text" name="name"
                            value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="detail__field">
                        <p class="detail__label">値段</p>
                        <input class="detail__input" type="number" name="price"
                            value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                        @error('price')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="detail__field">
                        <p class="detail__label">季節</p>
                        <div class="detail__seasons">
                            @foreach (['春', '夏', '秋', '冬'] as $season)
                                <label class="detail__season-item">
                                    <input type="checkbox" name="seasons[]" value="{{ $season }}"
                                        {{ in_array($season, old('seasons', $product->seasons->pluck('name')->toArray())) ? 'checked' : '' }}>
                                    {{ $season }}
                                </label>
                            @endforeach
                        </div>
                        @error('seasons')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="detail__description">
                <p class="detail__label">商品説明</p>
                <textarea class="detail__textarea" name="description"
                    placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="detail__actions">
                <a class="detail__btn detail__btn--back" href="/products">戻る</a>
                <button class="detail__btn detail__btn--save" type="submit">変更を保存</button>
                <button class="detail__btn detail__btn--delete" type="button"
                    onclick="document.getElementById('delete-form').submit()">
                    🗑
                </button>
            </div>
        </form>

        <form id="delete-form" action="/products/{{ $product->id }}/delete" method="POST">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('fileName').textContent = input.files[0].name;
            }
        }
    </script>
@endsection
