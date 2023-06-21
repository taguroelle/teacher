<?php

namespace App\Http\Controllers;

use App\Models\TeacherRegistrationControllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Teacher;
use DB;
class TeacherRegistrationController extends Controller
{
use ApiResponser;
private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        }
        public function getUsers(){
            $teachers = DB::connection('mysql')
        ->select("Select * from teachers");
        return $this->successResponse($teachers);
        }

    public function index()
    {
        $teachers = Teacher::all();
        return response()->json($teachers, 200);
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        return response()->json($teacher, 200);
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'email' => 'email|unique:teachers,email,' . $id,
            'address' => 'required|mas:50',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new teacher
        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->password = bcrypt($request->input('password'));
        $teacher->save();

        return response()->json(['message' => 'Teacher registered successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'email' => 'email|unique:teachers,email,' . $id,
            'address' => 'required|mas:50',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the teacher
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        // Update the teacher
        if ($request->has('name')) {
            $teacher->name = $request->input('name');
        }
        if ($request->has('email')) {
            $teacher->email = $request->input('email');
        }
        if ($request->has('password')) {
            $teacher->password = bcrypt($request->input('password'));
        }

        $teacher->save();

        return response()->json(['message' => 'Teacher updated successfully'], 200);
    }
}
