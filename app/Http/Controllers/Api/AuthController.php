<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
 
class AuthController extends Controller
{
    // ── Register ─────────────────────────────────────────────
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }
 
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        $token = JWTAuth::fromUser($user);
 
        return response()->json([
            'message' => 'Registrasi berhasil',
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }
 
    // ── Login ─────────────────────────────────────────────────
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
 
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }
 
        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => auth()->user(),
        ]);
    }
 
    // ── Profile ───────────────────────────────────────────────
    public function me()
    {
        return response()->json(['user' => auth()->user()]);
    }
 
    // ── Logout ────────────────────────────────────────────────
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout berhasil']);
    }
 
    // ── Refresh Token ─────────────────────────────────────────
    public function refresh()
    {
        return response()->json(['token' => auth()->refresh()]);
    }
}
