<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\TokenResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthService
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse|TokenResource
     */
    public function login(LoginRequest $request): JsonResponse|TokenResource
    {
        if (!$token = auth()->attempt($request->all())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return new TokenResource($token);
    }

    /**
     * @param RegistrationRequest $request
     * @return TokenResource
     */
    public function registration(RegistrationRequest $request): TokenResource
    {
        $this->user->fill($request->all());
        $this->user->save();
        $credentials = [
            'login' => $request->login,
            'password' => $request->password
        ];
        $token = auth()->attempt($credentials);
        return new TokenResource($token);
    }
}
