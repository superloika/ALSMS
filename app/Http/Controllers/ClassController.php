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
                    'clc.name as clc_name',
                    'clc.address as clc_address',
                )
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->join('clc','clc.id','classes.clc_id')

                ->where('classes.sy_id', $sy_id)
                ->orderBy('id','DESC')->get();

            return response()->json($classes);
        }
    }

    public function edit()
    {
        // dd(request()->id);

        $class = DB::table('classes')
            // ->select(
            //     'classes.*',
            //     'programs.title as program_title',
            //     'teachers.firstname',
            //     'teachers.middlename',
            //     'teachers.lastname',
            //     'clc.name as clc_name',
            //     'clc.address as clc_address',
            // )
            // ->join('programs','programs.id','classes.program_id')
            // ->join('teachers','teachers.id','classes.teacher_id')
            // ->join('clc','clc.id','classes.clc_id')

            ->find(request()->id);

        return response()->json($class);
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
                    'clc.name as clc_name',
                    'clc.address as clc_address',
                )
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->join('clc','clc.id','classes.clc_id')

                ->where('classes.sy_id', $sy_id)
                ->where('classes.teacher_id', $teacher_id)
                ->orderBy('id','DESC')->get();
            return response()->json($classes);
        // }
    }

    public function getClassStudents()
    {
        $class_id = request()->class_id ?? '';

        $students = DB::table('enrollment')
            ->select(
                'enrollment.*',
                'profiles.firstname',
                'profiles.middlename',
                'profiles.lastname',
                'profiles.gender',
                'programs.title',
                'clc.name as clc_name'
                // 'clc.name as clc_name',
                // 'clc.address as clc_address',
            )
            ->join('profiles','profiles.user_id','enrollment.user_id')
            ->join('classes','classes.id','enrollment.class_id')
            ->join('programs','programs.id','classes.program_id')
            ->join('clc','clc.id','classes.clc_id')
            ->where('enrollment.class_id', $class_id)

            ->orderBy('id','DESC')->get();
        return response()->json($students);
    }


    public function saveClass()
    {
        try {
            $data = request()->data;
            extract($data);

            $existing=DB::table('classes')
                ->where('program_id',$program_id)
                ->where('teacher_id',$teacher_id)
                ->where('clc_id',$clc_id)
                ->exists();
            if($existing) {
                return response()->json('Already existing', 500);
            }

            DB::table('classes')->insert([
                'sy_id'=>$sy_id,
                'program_id'=>$program_id,
                'teacher_id'=>$teacher_id,
                'clc_id'=>$clc_id,
                'sched_sun'=>$sched_sun ?? '',
                'sched_mon'=>$sched_mon ?? '',
                'sched_tue'=>$sched_tue ?? '',
                'sched_wed'=>$sched_wed ?? '',
                'sched_thu'=>$sched_thu ?? '',
                'sched_fri'=>$sched_fri ?? '',
                'sched_sat'=>$sched_sat ?? '',
            ]);

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update()
    {
        try {
            $data = request()->data;
            extract($data);

            DB::table('classes')
            ->where('id', $id)
            ->update([
                'sy_id'=>$sy_id,
                'program_id'=>$program_id,
                'teacher_id'=>$teacher_id,
                'clc_id'=>$clc_id,
                'sched_sun'=>$sched_sun ?? '',
                'sched_mon'=>$sched_mon ?? '',
                'sched_tue'=>$sched_tue ?? '',
                'sched_wed'=>$sched_wed ?? '',
                'sched_thu'=>$sched_thu ?? '',
                'sched_fri'=>$sched_fri ?? '',
                'sched_sat'=>$sched_sat ?? '',
            ]);

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function deleteClass()
    {
        try {
            $id = request()->id;
            DB::table('classes')->where('id', $id)->delete();
            return response()->json('Done', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


}
