<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRules = ['nullable', 'image', 'mimes:png,jpeg'];

        // 新規登録時は画像必須
        if ($this->isMethod('post')) {
            $imageRules = ['required', 'image', 'mimes:png,jpeg'];
        }

        return [
            'name' => ['required'],
            'price' => ['required', 'integer', 'min:0', 'max:10000'],
            'image' => $imageRules,
            'seasons' => ['required', 'array'],
            'description' => ['required', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min' => '0~10000円以内で入力してください',
            'price.max' => '0~10000円以内で入力してください',
            'image.required' => '画像を登録してください',
            'image.image' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
