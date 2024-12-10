<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginedController {
   
    public function index(Request $request)
{
    $email = $request->input('email');

    if (!$email) {
        return response()->json([
            'type' => 'error',
            'message' => 'Email is required',
        ], 400);
    }

    $user = User::where('email', $email)->firstOrFail();

    return response()->json([
        'type' => 'success',
        'user' => [
            'name' => $user->name,
            'email' => $user->email,
            'profile' => $user->profile,
        ],
    ], 200);
}
}
