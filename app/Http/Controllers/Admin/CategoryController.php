<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index($limit = 5)
    {
        // $list = DB::table('categories')
        //     ->select('cateid', 'catename', 'status', 'slug', 'description')
        //     ->where('status', 1)
        //     ->orderBy('catename')
        //     ->get();

        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status', 'description')
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename',
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'unique:categories,slug',
                    'regex:/^[a-z0-9-]+$/'
                ],
                'status' => 'required|in:0,1'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.'
            ],
            [
                'catename' => 'Tên danh mục',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái'
            ]
        );

        try {

            Category::create([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'description' => $request->description
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Thêm thành công');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show(string $id)
    {
        return "Chi tiết category: " . $id;
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'catename' => [
                    'required',
                    'min:3',
                    'max:100',
                    Rule::unique('categories', 'catename')
                        ->ignore($id, 'cateid')
                ],
                'slug' => [
                    'required',
                    'min:5',
                    'max:150',
                    'regex:/^[a-z0-9-]+$/',
                    Rule::unique('categories', 'slug')
                        ->ignore($id, 'cateid')
                ],
                'status' => 'required|in:0,1'
            ],
            [
                'required' => ':attribute không được để trống.',
                'min' => ':attribute phải từ :min ký tự trở lên.',
                'max' => ':attribute không vượt quá :max ký tự.',
                'unique' => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in' => ':attribute không hợp lệ.'
            ],
            [
                'catename' => 'Tên loại',
                'slug' => 'Đường dẫn (Slug)',
                'status' => 'Trạng thái'
            ]
        );

        try {

            $category = Category::findOrFail($id);

            $category->update([
                'catename'    => $request->catename,
                'slug'        => $request->slug,
                'description' => $request->description,
                'status'      => $request->status
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        return redirect()->route('admin.categories.index');
    }
}
