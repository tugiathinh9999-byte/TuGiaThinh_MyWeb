<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $list = DB::table('categories')
            ->select('cateid', 'catename', 'status', 'slug')
            ->where('status', 1)
            ->orderBy('catename')
            ->get();

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        DB::table('categories')->insert([
            'catename' => $request->catename,
            'slug' => $request->slug
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function show(string $id)
    {
        return "Chi tiết category: " . $id;
    }

    public function edit(string $id)
    {
        return "Form sửa category: " . $id;
    }

    public function update(Request $request, string $id)
    {
        return "Cập nhật category: " . $id;
    }

    public function destroy($id)
    {
        DB::table('categories')
            ->where('cateid', $id)
            ->delete();

        return redirect()->route('admin.categories.index');
    }
}