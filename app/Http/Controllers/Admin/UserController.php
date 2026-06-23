<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($limit = 5)
    {
        // $list = DB::table('users')
        //     ->select(
        //         'userid',
        //         'username',
        //         'slug',
        //         'description',
        //         'status'
        //     )
        //     ->where('status', 1)
        //     ->orderBy('username')
        //     ->get();
        $list = User::select('userid', 'username', 'slug', 'description', 'status')
            ->orderBy('username')
            ->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {

            User::create([
                'username' => $request->username,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.users.index')
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
        $user = User::findOrFail($id);

        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {

            $user = User::findOrFail($id);

            $user->update([
                'username' => $request->username,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status
            ]);

            return redirect()
                ->route('admin.users.index')
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
        DB::table('users')
            ->where('userid', $id)
            ->delete();

        return redirect()->route('admin.users.index');
    }
}
