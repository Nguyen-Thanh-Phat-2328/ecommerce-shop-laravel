<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InsertBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => ' :attribute không được để trống',
            'image.image' => ' :attribute phải là một hình ảnh',
            'image.mimes' => ' :attribute phải có định dạng: jpg, png, jpeg, gif, svg',
            'image.max' => ' :attribute không được vượt quá 2MB'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề bài viết',
            'image' => 'Ảnh bài viết'
        ];
    }
}
