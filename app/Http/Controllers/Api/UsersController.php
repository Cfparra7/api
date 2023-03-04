<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json([
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json([
                'data' => $user,
                'message' => 'Usuario creado con exito'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'errors' => $exception
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);
            return response()->json([
                'data' => $user,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'errors' => $exception,
            ], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormUserRequest $request, string $id)
    {
        try {
            $user = User::find($id)->update($request->all());
            return response()->json([
                'data' => $user,
                'message' => 'Se ha actualizado correctamente'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'errors' => $exception
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'data' => $user
                ], 200);
            }
            return response()->json([
                'errors' => 'El usuario no existe'
            ], 400);

        } catch (\Exception $exception) {
            return response()->json([
                'errors' => $exception
            ], 400);
        }
    }
}
