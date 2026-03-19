@extends('layouts.base')

@section('tab-title')
    商品登録 | mogitate
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register">
        <h2 class="register__title">商品登録</h2>

        <form class="register__form" action="/products/register" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- 商品名 --}}
            <div class="register__field">
                <div class="register__label-wrap">
                    <span class="register__label">商品名</span>
                    <span class="register__badge register__badge--required">必須</span>
                </div>
                <input class="register__input" type="text" name="name"
                    value="{{ old('name') }}" placeholder="商品名を入力">
                @foreach ($errors->get('name') as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach
            </div>

            {{-- 値段 --}}
            <div class="register__field">
                <div class="register__label-wrap">
                    <span class="register__label">値段</span>
                    <span class="register__badge register__badge--required">必須</span>
                </div>
                <input class="register__input" type="number" name="price"
                    value="{{ old('price') }}" placeholder="値段を入力">
                @foreach ($errors->get('price') as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach
            </div>

            {{-- 商品画像 --}}
            <div class="register__field">
                <div class="register__label-wrap">
                    <span class="register__label">商品画像</span>
                    <span class="register__badge register__badge--required">必須</span>
                </div>
                <img id="preview" class="register__preview" src="" alt="プレビュー">
                <div class="register__file-wrap">
                    <label class="register__file-btn">
                        ファイルを選択
                        <input type="file" name="image" accept=".png,.jpeg,.jpg"
                            onchange="previewImage(this)">
                    </label>
                    <span class="register__file-name" id="fileName">選択されていません</span>
                </div>
                @foreach ($errors->get('image') as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach
            </div>

            {{-- 季節 --}}
            <div class="register__field">
                <div class="register__label-wrap">
                    <span class="register__label">季節</span>
                    <span class="register__badge register__badge--required">必須</span>
                    <span class="register__badge register__badge--multi">複数選択可</span>
                </div>
                <div class="register__seasons">
                    @foreach (['春', '夏', '秋', '冬'] as $season)
                        <label class="register__season-item">
                            <input type="checkbox" name="seasons[]" value="{{ $season }}"
                                {{ in_array($season, old('seasons', [])) ? 'checked' : '' }}>
                            {{ $season }}
                        </label>
                    @endforeach
                </div>
                @foreach ($errors->get('seasons') as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach
            </div>

            {{-- 商品説明 --}}
            <div class="register__field">
                <div class="register__label-wrap">
                    <span class="register__label">商品説明</span>
                    <span class="register__badge register__badge--required">必須</span>
                </div>
                <textarea class="register__textarea" name="description"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @foreach ($errors->get('description') as $message)
                    <p class="form-error">{{ $message }}</p>
                @endforeach
            </div>

            {{-- ボタン --}}
            <div class="register__actions">
                <a class="register__btn register__btn--back" href="/products">戻る</a>
                <button class="register__btn register__btn--submit" type="submit">登録</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
                document.getElementById('fileName').textContent = input.files[0].name;
            }
        }
    </script>
@endsection
