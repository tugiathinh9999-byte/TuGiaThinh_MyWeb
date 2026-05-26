<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
        return "Demo1";
    }
    public function index2()
    {
        $data = "ABC";
        return view('demoindex2', compact('data'));
    }
    public function index3()
    {
        return response()->json([
            'name' => 'San Pham 1',
            'price' => 240000
        ]);
    }
    public function index4($id)
    {
        $data = "ABC";
        return view('demoindex4', compact('data', 'id'));
    }
    public function index5($id = null)
    {
        $data = "ABC";
        dump($id);
        #dd($id);
        return view('demoindex5', compact('data', 'id'));
    }
    public function index6($param1, $param2)
    {
        $data = "Laravel";

        return view('demoindex6', compact('data', 'param1', 'param2'));
    }
}
