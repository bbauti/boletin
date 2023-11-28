<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Inertia\Inertia;

class MyStudentsController extends Controller
{
    public function show()
    {
        return Inertia::render('App/MyStudents', [
            'users' => User::where('role', 'student')->get()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'course_id' => $user->course_id,
                    'role' => $user->role,
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->profile_photo_url,
                ];
            }),
            'courses' => Course::all()->map(function ($course) {
                return [
                    'id' => $course->id,
                    'course_name' => $course->course_name,
                    'academic_year' => $course->academic_year,
                    'in_charge' => $course->in_charge,
                    'assigned_classroom' => $course->assigned_classroom,
                ];
            }),
        ]);
    }
}
