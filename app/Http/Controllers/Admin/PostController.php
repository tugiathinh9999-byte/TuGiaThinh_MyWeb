<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 5)
    {
        // $list = DB::table('posts')
        //     ->orderBy('id', 'desc')
        //     ->get();

        $list = Post::with(['user:userid,username'])
            ->select('id', 'title', 'slug', 'content', 'userid', 'status')
            ->orderBy('title')
            ->paginate($limit);

        return view('admin.posts.index', compact('list'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {

            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'status' => $request->status,
                'content' => $request->input('content'),
                'userid' => 1
            ]);

            return redirect()
                ->route('admin.posts.index')
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
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        $users = User::orderBy('username')->get();

        return view(
            'admin.posts.edit',
            compact('post', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {

            $post = Post::findOrFail($id);

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->input('content'),
                'status' => $request->status,
                'userid' => 1
            ]);

            return redirect()
                ->route('admin.posts.index')
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
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect()->route('admin.posts.index');
    }
}
