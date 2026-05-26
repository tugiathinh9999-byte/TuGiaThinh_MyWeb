<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return "Danh sách category";
    }

    public function create()
    {
        return "Form thêm category";
    }

    public function store(Request $request)
    {
        return "Lưu category";
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

    public function destroy(string $id)
    {
        return "Xóa category: " . $id;
    }
}