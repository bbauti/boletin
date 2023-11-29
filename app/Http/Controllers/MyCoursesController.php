<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class MyCoursesController extends Controller
{
    public function show()
    {
        return Inertia::render('App/MyCourses', [
            'users' => User::where('role', 'teacher')->get()->map(function ($user) {
                return [
                    'id' => $user->id,
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
            'classrooms' => Classroom::all()->map(function ($classroom) {
                return [
                    'id' => $classroom->id,
                    'classroom_name' => $classroom->classroom_name,
                ];
            }),
        ]);
    }
    public function deleteCourse(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }
        User::where('course_id', $course->id)->update(['course_id' => null]);
        $course->delete();

        return response()->json([
            'status' => 'success',
            'type' => 'delete'
        ]);
    }
    public function createCourse(Request $request)
    {
        // Validate the incoming request
        /* $request->validate([
            'course_name' => 'required|string',
            'academic_year' => 'required|numeric',
            'in_charge' => 'required|string',
            'assigned_classroom' => 'required|string',
        ]); */

        // Create a new course
        if (isEmpty($request->assigned_classroom)) {
            $request->assigned_classroom = null;
        }
        Course::create($request->all());

        return response()->json([
            'status' => 'success',
            'type' => 'create'
        ]);
    }
    public function updateCourse(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        // TODO: hacer dinamico
        if ($course->academic_year === $request->academic_year &&
            $course->assigned_classroom === $request->assigned_classroom &&
            $course->course_name === $request->course_name &&
            $course->in_charge === $request->in_charge) {
                return response()->json([
                    'status' => 'duplicated',
                    'type' => 'update',
                ]);
            }

        $course->update($request->all());

        return response()->json([
            'request' => $request->all(),
            'course' => $course,
            'status' => 'success',
            'type' => 'update',
        ]);
    }
}
