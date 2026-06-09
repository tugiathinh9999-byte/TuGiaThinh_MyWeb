<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.cateid')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
            ->select(
                'products.*',
                'categories.catename',
                'brands.brandname'
            )
            ->get();

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')
            ->where('status', 1)
            ->get();

        $brands = DB::table('brands')
            ->where('status', 1)
            ->get();

        return view(
            'admin.products.create',
            compact('categories', 'brands')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('products')->insert([
            'productname' => $request->productname,
            'slug' => $request->slug,
            'price' => $request->price,
            'pricediscount' => $request->pricediscount,
            'description' => $request->description,
            'image' => null,
            'cateid' => $request->cateid,
            'brandid' => $request->brandid,
            'status' => 1
        ]);

        return redirect()->route('admin.products.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('products')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.products.index');
    }
    public function test1()
    {
        return redirect()->route('admin.home');
    }
    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}
