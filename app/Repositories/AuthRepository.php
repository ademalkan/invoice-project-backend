<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


interface AuthInterfaces
{
    public function createUser(array $registerRequestData): ?Response;
    public function loginUser(array $loginRequestData): ?Response;
}
/**
 * Class AuthRepository.
 */
class AuthRepository implements AuthInterfaces
{
    public function createUser(array $registerRequestData): ?Response
    {

        try {
            $user = User::create([
                'name' => $registerRequestData["name"],
                'email' => $registerRequestData["email"],
                'password' => Hash::make($registerRequestData["password"])
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(array $loginRequestData): ?Response
    {
        try {
            $user = User::where('email', $loginRequestData["email"])->first();
            if ($user) :
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            else :
                return response()->json([
                    'status' => false,
                    'message' => 'Username or Password Do Not Match',
                ], 400);
            endif;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
