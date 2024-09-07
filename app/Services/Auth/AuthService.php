<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{
    public function register($request): array
    {
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
        ]);

        $token = $user->createToken('tokenWarehouseCrm')->plainTextToken;
        $userId = $user->id;

        return [
          'userId' =>  $userId,
          'token' => $token,
        ];
    }
    public function login($request): array
    {
        $user = User::where('email', $request->validated('email'))->first();

        if (!Hash::check($request->validated('password'), $user->password)) {
            $passwordIncorrect = __('auth.invalid_password');
            throw new \InvalidArgumentException($passwordIncorrect, 422);
        }

        $token = $user->createToken('tokenWarehouseCrm')->plainTextToken;
        $userId = $user->id;

        return [
          'userId' =>  $userId,
          'token' => $token,
        ];
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function show($id): ?User
    {
        return User::find($id);
    }

    public function logout(Request $request): void
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
        cookie()->forget('token');
    }
}
