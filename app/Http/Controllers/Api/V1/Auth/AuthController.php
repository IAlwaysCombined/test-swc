<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\TokenResource;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return TokenResource|JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse|TokenResource
    {
        return $this->authService->login($request);
    }

    /**
     * Get a JWT via registration user.
     *
     * @param RegistrationRequest $request
     * @return TokenResource
     */
    public function registration(RegistrationRequest $request): TokenResource
    {
       return $this->authService->registration($request);
    }
}
