<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

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

    public function update(Request $request, $id)
    {
        try {

            $category = Category::findOrFail($id);

            $category->update([
                'catename' => $request->catename,
                'slug' => $request->slug,
                'status' => $request->status,
                'description' => $request->description
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

    public function destroy($id)
    {
        DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        return redirect()->route('admin.categories.index');
    }
}