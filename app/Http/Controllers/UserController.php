<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function updateCourse(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validate the request data if needed
        $request->validate([
            'course' => 'required|string', // Add any validation rules as needed
        ]);

        // Update the "course" column
        $user->course = $request->input('course');
        $user->save();

        return response()->json(['message' => 'User course updated successfully']);
    }
}
