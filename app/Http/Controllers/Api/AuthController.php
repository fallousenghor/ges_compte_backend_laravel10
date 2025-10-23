<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Client;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required|in:client,admin',
            // Champs spécifiques pour client
            'type_client' => 'required_if:type,client|in:Particulier,Entreprise',
            'numero_client' => 'required_if:type,client|string|unique:clients,numero_client',
            // Champs spécifiques pour admin
            'departement' => 'required_if:type,admin|string',
            'fonction' => 'required_if:type,admin|string'
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', 422, $validator->errors());
        }

        try {
            if ($request->type === 'client') {
                $userable = Client::create([
                    'type_client' => $request->type_client,
                    'numero_client' => $request->numero_client
                ]);
            } else {
                $userable = Admin::create([
                    'departement' => $request->departement,
                    'fonction' => $request->fonction
                ]);
            }

            $user = $userable->user()->create([
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'adresse' => $request->adresse
            ]);

            $token = $user->createToken('auth_token')->accessToken;

            // Return only the token as requested
            return response()->json([
                'access_token' => $token
            ], 201);

        } catch (\Exception $e) {
            return $this->error('Registration failed', 500, $e->getMessage());
        }
    }

    /**
     * Login user and create token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation error', 422, $validator->errors());
        }

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        $user = auth()->user();
        $tokenResult = $user->createToken('auth_token');

        // Return only the token string
        return response()->json([
            'access_token' => $tokenResult->accessToken
        ], 200);
    }

    /**
     * Get the authenticated user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return $this->success([
            'user' => $request->user()->load('userable')
        ]);
    }

    /**
     * Logout user (Revoke the token).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->success(null, 'Successfully logged out');
    }
}
