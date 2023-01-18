<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
    }


    public function getClasses()
    {
        $sy_id = request()->sy_id ?? '';
        if($sy_id != ''){
            $classes = DB::table('classes')
                ->select(
                    'classes.*',
                    'programs.title as program_title',
                    'teachers.firstname',
                    'teachers.middlename',
                    'teachers.lastname',
                )
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->where('classes.sy_id', $sy_id)
                ->latest()->get();
            return response()->json($classes);
        }
    }

    public function getTeacherClasses()
    {
        $sy_id = request()->sy_id ?? '';
        $teacher_id = request()->teacher_id ?? '';

        // if($sy_id != ''){
            $classes = DB::table('classes')
                ->select(
                    'classes.*',
                    'programs.title as program_title',
                    'teachers.firstname',
                    'teachers.middlename',
                    'teachers.lastname',
                )
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->where('classes.sy_id', $sy_id)
                ->where('classes.teacher_id', $teacher_id)
                ->orderBy('id','DESC')->get();
            return response()->json($classes);
        // }
    }


    public function saveClass()
    {
        try {
            $data = request()->data;
            extract($data);

            DB::table('classes')->insert([
                'sy_id'=>$sy_id,
                'program_id'=>$program_id,
                'teacher_id'=>$teacher_id,
                'created_by'=>Auth::user()->id
            ]);

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


}
