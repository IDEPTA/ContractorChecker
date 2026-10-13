<?php

namespace App\Authentication\Domain\Services;

use App\Authentication\Http\Requests\LoginRequest;
use App\Authentication\Http\Requests\RegisterRequest;
use App\Shared\Infrastructure\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param LoginRequest $data
     *
     * @return string
     * @throws AuthenticationException
     */
    public function login(LoginRequest $data): string|AuthenticationException
    {
        $data = $data->validated();
        $user = User::whereEmail($data['email'])->first();

        if (
            $user &&
            Hash::check($data['password'], $user->password)
        ) {
            $token = $user
                ->createToken("auth_token")
                ->plainTextToken;

            return $token;
        }

        throw new AuthenticationException("Invalid password or email");
    }

    /**
     * @param RegisterRequest $data
     *
     * @return string
     */
    public function register(RegisterRequest $data): string
    {
        $data = $data->validated();
        $user = User::create($data);

        $token = $user
            ->createToken("auth_token")
            ->plainTextToken;

        return $token;
    }

    /**
     * @param Request $token
     *
     * @return bool
     */
    public function logout(Request $token): bool
    {
        $token->user()->currentAccessToken()->delete();

        return true;
    }
}