<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("login");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'nama bunga wajib diisi',
                'password.required' => ' jumlah bunga wajib diisi'
            ]
        );

        $username = $request->username;
        $password = $request->password;

        $user_data = User::where([
            "username" => $username
        ])->first();

        if($user_data === null){
            return redirect()->route("user.login")->withErrors([
                "message" => "Username tidak ditemukan"
            ]);
        }

        if(!Hash::check($password,$user_data->password)){
            return redirect()->route("user.login")->withErrors([
                "message" => "Password salah"
            ]);
        }

        $jwtSecret = env('JWT_SECRET');
        $issuedAt = time();
        $payload = [
            "iat" => time(),
            "exp" => $issuedAt + 3600 * 24,
            "username" => $username
        ];

        $token = JWT::encode($payload, $jwtSecret, 'HS256');
        $user_data->update([
            "token" => $token
        ]);
        session(["kembangku_user_token" => $token]);

        return redirect()->route("dashboard");

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
        //
    }
}
