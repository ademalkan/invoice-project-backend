<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    protected $authRepositroy;

    public function __construct(AuthRepository $authRepositroy)
    {
        $this->authRepositroy = $authRepositroy;
    }

    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(RegisterRequest $registerRequest)
    {

        try {
            $registerRequest = $registerRequest->validated();
            return $this->authRepositroy->createUser($registerRequest);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(LoginRequest $loginRequest)
    {
        try {
            $loginRequest = $loginRequest->validated();
            return $this->authRepositroy->loginUser($loginRequest);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
