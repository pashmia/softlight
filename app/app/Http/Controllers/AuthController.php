<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Логин и выдача API токена
     */
    public function login(Request $request)
    {
        // Валидация входящих данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Попытка аутентификации
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Аутентифицированный пользователь
        $user = Auth::user();

        // Создание персонального API токена
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
