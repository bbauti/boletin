<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class MyStudentsController extends Controller
{
    public function show()
    {
        return Inertia::render('App/MyStudents', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ];
            }),
        ]);
    }
}
