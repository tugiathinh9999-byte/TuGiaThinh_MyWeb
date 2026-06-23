<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'username' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('users', 'username')->ignore($userId, 'userid'),
            ],
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:150',
                Rule::unique('users', 'slug')->ignore($userId, 'userid'),
                'regex:/^[a-z0-9-]+$/',
            ],
            'description' => [
                'nullable',
                'regex:/^[^@!$^]*$/',
            ],
            'status' => [
                'required',
                'in:0,1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'string' => ':attribute phải là chuỗi.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'description.regex' => ':attribute không được chứa các ký tự @, !, $, ^.',
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => 'Tên người dùng',
            'slug' => 'Đường dẫn (Slug)',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
        ];
    }
}
