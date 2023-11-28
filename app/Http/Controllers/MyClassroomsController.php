<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Inertia\Inertia;

class MyClassroomsController extends Controller
{
    public function show()
    {
        return Inertia::render('App/MyClassrooms', [
            'classrooms' => Classroom::all()->map(function ($classroom) {
                return [
                    'id' => $classroom->id,
                    'classroom_name' => $classroom->classroom_name,
                ];
            }),
        ]);
    }
}
