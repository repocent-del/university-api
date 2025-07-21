<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ProfessorController;
use App\Http\Controllers\Api\V1\CourseController;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('v1/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ], 201);
});

Route::post('v1/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    });

    Route::apiResource('professors', ProfessorController::class);
    Route::apiResource('courses', CourseController::class);
});
