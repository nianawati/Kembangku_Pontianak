<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $routeName = $request->route()->getName();

        if ($routeName === "user.login") {

            $token_session = session("kembangku_user_token");
            if($token_session !== null){
                try {
                    $key = env("JWT_SECRET");
                    $decoded = JWT::decode($token_session, new Key($key, 'HS256'));
    
                    $username = $decoded->username;
                    $user_data = User::where("username", $username)->first();
    
                    if ($user_data === null) {
                        throw new Exception("User tidak ditemukan");
                    }
    
                    if ($user_data->token !== $token_session) {
                        throw new Exception("Autentikasi gagal");
                    }
    
                    return redirect()->route("dashboard");
    
                } catch (Exception $err) {
                    session()->remove("kembangku_user_token");
                    return $next($request);
                }
            }

            return $next($request);

        }else if($routeName === "user.logout"){

            $token_session = session("kembangku_user_token");
            if($token_session !== null){
                try {
                    $key = env("JWT_SECRET");
                    $decoded = JWT::decode($token_session, new Key($key, 'HS256'));
    
                    $username = $decoded->username;
                    $user_data = User::where("username", $username)->first();
    
                    if ($user_data === null) {
                        throw new Exception("User tidak ditemukan");
                    }
    
                    if ($user_data->token !== $token_session) {
                        throw new Exception("Autentikasi gagal");
                    }
    
                    return $next($request);
    
                } catch (Exception $err) {
                    session()->remove("kembangku_user_token");
                    return redirect()->route("user.login");
                }
            }

            return redirect()->route("user.login");

        }else if($routeName === "kasir"){

            $token_session = session("kembangku_user_token");
            if($token_session !== null){
                try {
                    $key = env("JWT_SECRET");
                    $decoded = JWT::decode($token_session, new Key($key, 'HS256'));
    
                    $username = $decoded->username;
                    $user_data = User::where("username", $username)->first();
    
                    if ($user_data === null) {
                        throw new Exception("User tidak ditemukan");
                    }
    
                    if ($user_data->token !== $token_session) {
                        throw new Exception("Autentikasi gagal");
                    }

                    $request->merge([
                        "name" => $username,
                        "foto_profile_show" => $user_data->foto_profile,
                        "rule_user" => $user_data->rule
                    ]);
    
                    return $next($request);
    
                } catch (Exception $err) {
                    session()->remove("kembangku_user_token");
                    return redirect()->route("user.login", 402)->withErrors([
                        "message" => "Gagal autentikasi user",
                        "token" => $token_session
                    ]);
                }
            }

            return $next($request);

        } else {
            $token_bearer = $request->bearerToken();
            $token_session = session("kembangku_user_token");
            if ($token_bearer == null && $token_session != null) {
                try {
                    $key = env("JWT_SECRET");
                    $decoded = JWT::decode($token_session, new Key($key, 'HS256'));

                    $username = $decoded->username;
                    $user_data = User::where("username", $username)->first();

                    if ($user_data == null) {
                        throw new Exception("User tidak ditemukan");
                    }

                    if ($user_data->token != $token_session) {
                        throw new Exception("Autentikasi gagal");
                    }

                    $request->merge([
                        "name" => $username,
                        "rule_user" => $user_data->rule,
                        "foto_profile_show" => $user_data->foto_profile,
                    ]);

                    if($user_data->rule === "karyawan"){
                        return redirect()->route("kasir");
                    }
                    
                    return $next($request);

                } catch (Exception $err) {
                    return redirect()->route("user.login", 402)->withErrors([
                        "message" => $err->getMessage()
                    ]);
                }

            } else if ($token_bearer != null && $token_session == null) {
                try {
                    $key = env("JWT_SECRET");
                    $decoded = JWT::decode($token_session, new Key($key, 'HS256'));

                    $username = $decoded->username;
                    $user_data = User::where("username", $username)->first();

                    if ($user_data == null) {
                        throw new Exception("User tidak ditemukan");
                    }

                    if ($user_data->token != $token_session) {
                        throw new Exception("Autentikasi gagal");
                    }

                    $request->merge([
                        "name" => $username,
                        "rule_user" => $user_data->rule,
                        "foto_profile_show" => $user_data->foto_profile,
                    ]);

                    if($user_data->rule === "karyawan"){
                        return redirect()->route("kasir");
                    }

                    return $next($request);

                } catch (Exception $err) {
                    return redirect()->json([
                        "message" => $err->getMessage()
                    ], 402, [
                        "Content-Type" => "application/json"
                    ]);
                }
            } else {
                return redirect()->route("user.login", 402)->withErrors([
                    "message" => "Gagal autentikasi user",
                    "token" => $token_session
                ]);
            }

        }

    }
}
