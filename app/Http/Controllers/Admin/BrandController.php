<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 5)
    {
        // $list = DB::table('brands')
        //     ->select('brandid', 'brandname', 'status', 'slug', 'description')
        //     ->where('status', 1)
        //     ->orderBy('brandname')
        //     ->get();

        $list = Brand::select('brandid', 'brandname', 'slug', 'image', 'status', 'description')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            Brand::create([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm thành công');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        $id
    ) {
        try {

            $brand = Brand::findOrFail($id);

            $brand->update([
                'brandname' => $request->brandname,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Cập nhật thành công');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('brands')
            ->where('brandid', $id)
            ->delete();

        return redirect()->route('admin.brands.index');
    }
}
