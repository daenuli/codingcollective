<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="API Endpoints of Authentication"
 * )
 */

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      summary="Sign in",
     *      tags={"Authentication"},
     *      @OA\RequestBody(
     *         required=true,
     *         description="User auth",
     *         @OA\JsonContent(
     *         required={"email", "password"},
     *              @OA\Property(property="email", type="string", format="email", example="senior@example.com"),
     *              @OA\Property(property="password", type="string", format="password", example="111111"),
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successful",
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Wrong credentials response",
     *              @OA\JsonContent(
     *                  @OA\Property(property="errors", type="string", example="Incorrect Details. Please try again")
     *              )
     *       )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if(!auth()->attempt($data)) {
            return response()->json(['errors' => 'Incorrect Details. Please try again'], 422);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json([
            'user' => auth()->user(),
            'token' => $token
        ], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/logout",
     *      summary="Logout",
     *      description="Logout user and invalidate token",
     *      tags={"Authentication"},
     *      security={{ "passport":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *       )
     *     )
     * )
     */

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'You have been successfully logged out!'
        ], 200);
    }
}
