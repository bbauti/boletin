<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateCourse(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->course_id !== null && $request->input('course') !== 0) {
            $type = 'update';
        } else if ($user->course_id === null && $request->input('course') !== 0) {
            $type = 'assign';
        } else if ($user->course_id !== null && $request->input('course') === 0) {
            $type = 'remove';
        }

        $user->course_id = $request->input('course') === 0 ? null : $request->input('course');
        $user->save();

        return response()->json([
            'status' => 'success',
            'type' => $type
            ]);
    }

    /* public function updateRole(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->role = $request->input('role');
        $user->save();

        return response()->json([
            'status' => 'success',
            ]);
    } */
}
