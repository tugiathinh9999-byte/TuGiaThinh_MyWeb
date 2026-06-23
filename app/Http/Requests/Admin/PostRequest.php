<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $id = $this->route('post');

        return [
            'title' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('posts', 'title')->ignore($id, 'id'),
            ],
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:200',
                Rule::unique('posts', 'slug')->ignore($id, 'id'),
                'regex:/^[a-z0-9-]+$/',
            ],
            'content' => [
                'required',
                'string',
                'min:10',
            ],
            'status' => [
                'required',
                'in:0,1',
            ],
            'userid' => [
                'nullable',
                'exists:users,userid',
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
            'userid.exists' => 'Người dùng không tồn tại.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn (Slug)',
            'content' => 'Nội dung',
            'status' => 'Trạng thái',
            'userid' => 'Người đăng',
        ];
    }
}
