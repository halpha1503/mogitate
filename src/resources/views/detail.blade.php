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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" width="18" height="18">
                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
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
