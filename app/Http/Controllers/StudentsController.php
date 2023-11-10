<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function index(){
        $students = Students::all();
        if ($students->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'students' => $students
                ]
            );
        }
        else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'No Records Found'
                ]
            );
        }
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
            'course' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        } else {
            $student = Students::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'course' => $request->course,
            ]);
    
            if ($student) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Student added successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ]);
            }
        }
    }

    public function show($id)
    {
        $student=Students::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' =>'No Such Student Found'
            ]);
        }
    }
    public function edit($id){
        $student=Students::find($id);
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' =>'No Such Student Found'
            ]);
        }
    }
    public function update(Request $request,int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
            'course' => 'required|string|max:191',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ]);
        } else {
            $student = Students::find($id);
           
    
            if ($student) {
                $student ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'course' => $request->course,
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Student updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No such student found'
                ]);
            }
        }
    }
    public function destroy($id){
        $student = Students::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Student deleted successfully'
            ]);
        }else 
        {
            return response()->json([
                'status' => 404,
                'message' => 'No such student found'
            ]);
        }
    }

    }
