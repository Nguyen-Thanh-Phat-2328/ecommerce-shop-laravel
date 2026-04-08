<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric',
            'id_category' => 'required',
            'id_brand' => 'required',
            'detail' => 'required',
            'status' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'requeired' => ':attribute không được để trống',
            'numeric' => ':attribute phải là số',
            // 'image' => ':attribute phải là file ảnh',
            // 'mimes' => ':attribute phải có định dạng jpeg, png, jpg, gif, svg',
            // 'max' => ':attribute không được lớn hơn 2048KB',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'id_category' => 'Danh mục',
            'id_brand' => 'Thương hiệu',
            'detail' => 'Chi tiết sản phẩm',
            // 'image' => 'Ảnh sản phẩm',
        ];
    }
}
