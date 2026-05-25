<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageSaveTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use ImageSaveTrait;

    public function index()
    {
        $users = User::all();
        return view("backend.user.index", compact("users"));
    }


    public function create()
    {

        return view("backend.user.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "phone" => "required|unique:users,phone",
            "password" => "nullable|min:6",
            ""
        ]);

        if ($request->hasFile('image')) {
            $image_name = $this->saveImage('profile', $request->file('image'), 400, 400);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'nid' => $request->nid,
            'password' => Hash::make($request->password),
            'image' => $image_name ?? '',
        ]);

        return redirect()->route('user.index')->with('success', 'User Created Successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view("backend.user.show", compact("user"));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("backend.user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email," . $id,
            "phone" => "required|unique:users,phone," . $id,
            "password" => "nullable|min:6",
        ]);


        $user = User::find($id);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'nid'     => $request->nid,
        ];

        // ✅ password check
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // ✅ image upload
        if ($request->hasFile('image')) {
            if (!empty($user->image)) {
                $this->deleteImage(public_path($user->image));
            }

            $data['image'] = $this->saveImage('profile', $request->file('image'), 400, 400);
        }

        // update
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        try {
            $this->deleteImage(public_path($user->image));
            // Delete brand
            $user->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'User Deleted Successfully'], 200);
    }
}