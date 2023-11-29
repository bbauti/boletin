<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Http\Request;
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
    public function deleteClassroom(Request $request, $id)
    {
        $classroom = Classroom::find($id);

        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }
        Course::where('assigned_classroom', $classroom->id)->update(['assigned_classroom' => null]);
        $classroom->delete();

        return response()->json([
            'status' => 'success',
            'type' => 'delete'
        ]);
    }
    public function updateClassroom(Request $request, $id)
    {
        $classroom = Classroom::find($id);

        // TODO: Mejorar validaciones, no permitir con el mismo nombre

        if (!$classroom) {
            return response()->json(['message' => 'Classroom not found'], 404);
        }

        // TODO: hacer dinamico
        if ($classroom->classroom_name === $request->classroom_name) {
                return response()->json([
                    'status' => 'duplicated',
                    'type' => 'update',
                ]);
            }

        $classroom->update($request->all());

        return response()->json([
            'status' => 'success',
            'type' => 'update',
        ]);
    }
    public function createClassroom(Request $request)
    {
        // Validate the incoming request
        /* $request->validate([
            'course_name' => 'required|string',
            'academic_year' => 'required|numeric',
            'in_charge' => 'required|string',
            'assigned_classroom' => 'required|string',
        ]); */

        Classroom::create($request->all());

        return response()->json([
            'status' => 'success',
            'type' => 'create'
        ]);
    }
}
