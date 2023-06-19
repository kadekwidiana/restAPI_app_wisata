<?php

namespace App\Http\Controllers\API\AUTH;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            $register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($register != null) {
                return response()->json([
                    'success' => true,
                    'message' => 'Register success',
                    'dataRegister' => $register
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Register gagal'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Register gagal',
                'errors' => $e->getMessage()
            ]);
        }
    }
}
