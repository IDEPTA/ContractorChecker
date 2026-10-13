<?php

namespace App\Authentication\Http\Controllers;

use App\Authentication\Domain\Services\AuthService;
use App\Authentication\Http\Requests\LoginRequest;
use App\Authentication\Http\Requests\RegisterRequest;
use App\Shared\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function login(LoginRequest $request): JsonResponse| ErrorResource
    {
        try {
            $token = $this->authService->login($request);

            return response()->json([
                "token" => $token
            ], 200);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }

    /**
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function register(RegisterRequest $request): JsonResponse| ErrorResource
    {
        try {
            $token = $this->authService->register($request);

            return response()->json([
                "token" => $token,
                "message" => "Registration was successful"
            ], 200);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ErrorResource
     */
    public function logout(Request $request): JsonResponse|ErrorResource
    {
        try {
            $this->authService->logout($request);

            return response()->json([
                "message" => "You have logged out",
                "success" => true
            ]);
        } catch (Exception $e) {
            return new ErrorResource($e);
        }
    }
}