<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 5)
    {
        // $list = DB::table('products')
        //     ->join('categories', 'products.cateid', '=', 'categories.cateid')
        //     ->leftJoin('brands', 'products.brandid', '=', 'brands.brandid')
        //     ->select(
        //         'products.*',
        //         'categories.catename',
        //         'brands.brandname'
        //     )
        //     ->get();
        $list = Product::with(['category:cateid,catename', 'brand:brandid,brandname'])
            ->select('id', 'productname', 'slug', 'price', 'pricediscount', 'description', 'cateid', 'brandid', 'status')
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('brandid', 'brandname')->where('status', 1)->get();

        return view(
            'admin.products.create',
            compact('categories', 'brands')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {

            Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'description'   => $request->description,
                'status'        => $request->status,
            ]);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
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
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::orderBy('catename')->get();

        $brands = Brand::orderBy('brandname')->get();

        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories',
                'brands'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {

            $product = Product::findOrFail($id);

            $product->update([
                'productname' => $request->productname,
                'slug' => $request->slug,
                'cateid' => $request->cateid,
                'brandid' => $request->brandid,
                'price' => $request->price,
                'pricediscount' => $request->pricediscount,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.products.index')
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
