<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view("admin.user.user", compact("user"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.userTambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required',
                'password' => 'required',
                'rule' => 'required',
                'foto_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:10480'
            ],
            [
                'username.required' => 'Username wajib diisi',
                'email.required' => ' Email wajib diisi',
                'password.required' => 'Password wajib diisi',
                'rule.required' => 'Password wajib diisi',
                'foto_profile.required' => 'Foto Profil Wajib Di Isi'
            ]
        );

        if ($request->file('foto_profile')) {
            $filename = time() . '.' . $request->foto_profile->extension();
            $request->foto_profile->move(public_path('foto_profile'), $filename);

            //tambah data produk
            User::insert([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rule' => $request->rule,
                'token' => "",
                "foto_profile" => $filename
            ]);

            return redirect()->route('user');

        } else {
            return back()->withErrors([
                "message" => "Gagal mengupload foto"
            ]);
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
    public function edit(User $id)
    {
        return view("admin.user.userEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required',
                'rule' => 'required'
            ],
            [
                'username.required' => 'Username wajib diisi',
                'email.required' => ' Email wajib diisi',
                'rule.required' => 'Password wajib diisi'
            ]
        );

        $user = User::where("id",$id)->first();
        if ($request->file('foto_profile')) {
            $filename = time() . '.' . $request->foto_profile->extension();
            if(strlen($user->foto_profile) > 0){
                if (File::exists(public_path('foto_profile/').$user->foto_profile)) {
                    File::delete(public_path('foto_profile/').$user->foto_profile);
                }
            }
            $request->foto_profile->move(public_path('foto_profile'), $filename);

            //update data user
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'rule' => $request->rule,
                'foto_profile' => $filename
            ]);

            return redirect()->route('user');

        } else {
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'rule' => $request->rule
            ]);

            return redirect()->route('user');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id)
    {
        $id->delete();

        return redirect()->route(route: 'user')
            ->with('message', 'Data berhasil di hapus');
    }
}
