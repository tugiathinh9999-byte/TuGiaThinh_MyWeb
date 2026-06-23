<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $id = $this->route('product');

        return [
            'productname' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('products', 'productname')
                    ->ignore($id, 'id'),
            ],

            'slug' => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('products', 'slug')
                    ->ignore($id, 'id'),
                'regex:/^[A-Za-z0-9_-]+$/',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:10000000',
            ],

            'pricediscount' => [
                'nullable',
                'numeric',
                'min:0',
                'lte:price',
            ],

            'status' => [
                'required',
                'in:0,1',
            ],

            'cateid' => [
                'required',
                'exists:categories,cateid',
            ],

            'brandid' => [
                'required',
                'exists:brands,brandid',
            ],

            'description' => [
                'nullable',
                'regex:/^[^@!$^]*$/',
            ],
        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'numeric' => ':attribute phải là số.',
            'min' => ':attribute phải lớn hơn hoặc bằng :min.',
            'max' => ':attribute không được vượt quá :max.',
            'unique' => ':attribute đã tồn tại.',
            'exists' => ':attribute không tồn tại.',

            'slug.regex' =>
            ':attribute chỉ được chứa chữ, số, dấu gạch dưới (_) và dấu gạch ngang (-).',

            'description.regex' =>
            ':attribute không được chứa các ký tự @, !, $, ^.',

            'pricediscount.lte' =>
            'Giá khuyến mãi không được lớn hơn giá gốc.',

            'status.in' =>
            'Trạng thái không hợp lệ.',
        ];
    }

    /**
     * Friendly Attribute Names
     */
    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Slug',
            'price' => 'Giá',
            'pricediscount' => 'Giá khuyến mãi',
            'cateid' => 'Danh mục',
            'brandid' => 'Thương hiệu',
            'status' => 'Trạng thái',
            'description' => 'Mô tả',
        ];
    }
}
