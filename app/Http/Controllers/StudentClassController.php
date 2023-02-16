<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
        $this->middleware(['auth']);
    }


    // public function all()
    // {
    //     $sy_id = request()->sy_id ?? '';
    //     if($sy_id != ''){
    //         $classes = DB::table('classes')
    //             ->select(
    //                 'classes.*',
    //                 'enrollment.user_id',
    //                 'enrollment.status',
    //                 'programs.title as program_title',
    //                 'teachers.firstname',
    //                 'teachers.middlename',
    //                 'teachers.lastname',
    //                 'profiles.verified',
    //                 'clc.name as clc_name',
    //                 'clc.address as clc_address',
    //             )
    //             ->leftJoin('enrollment','enrollment.class_id','classes.id')
    //             ->leftJoin('profiles','profiles.user_id','enrollment.user_id')
    //             ->join('programs','programs.id','classes.program_id')
    //             ->join('teachers','teachers.id','classes.teacher_id')
    //             ->join('clc','clc.id','classes.clc_id')
    //             ->where('classes.sy_id', $sy_id)
    //             ->orWhere('enrollment.user_id', Auth::user()->id)
    //             ->orderBy('id','desc')->get();

    //         return response()->json($classes);
    //     }
    // }

    public function studentEnrollment()
    {
        $sy_id = request()->sy_id ?? '';
        if($sy_id != ''){
            $classes = DB::table('enrollment')
                ->select(
                    'enrollment.id',
                    'enrollment.user_id',
                    'enrollment.status',
                    'classes.program_id',
                    'classes.teacher_id',
                    'classes.clc_id',
                    'programs.title as program_title',
                    'programs.description_long as program_description',
                    'programs.attachments',
                    'teachers.firstname',
                    'teachers.middlename',
                    'teachers.lastname',
                    'profiles.verified',
                    'clc.name as clc_name',
                    'clc.address as clc_address',
                )
                ->leftJoin('classes','classes.id','enrollment.class_id')
                ->leftJoin('profiles','profiles.user_id','enrollment.user_id')
                ->leftJoin('programs','programs.id','classes.program_id')
                ->leftJoin('teachers','teachers.id','classes.teacher_id')
                ->leftJoin('clc','clc.id','classes.clc_id')
                // ->where('classes.sy_id', $sy_id)
                ->where('enrollment.sy_id', $sy_id)
                ->where('enrollment.user_id', Auth::user()->id)
                // ->orderBy('id','desc')
                ->get();

            return response()->json($classes);
        }
    }

    public function enroll() {
        try {
            $user_id = Auth::user()->id;
            $sy = DB::table('sys')->where('status',1)->get()->first();
            // dd($sy);

            if(DB::table('profiles')->where('user_id', $user_id)->exists()==false) {
                return response()->json('Setup your student profile first', 404);
            }

            DB::table('enrollment')->insert([
                'sy_id'=>$sy->id,
                'user_id'=>$user_id,
                'created_by'=>$user_id,
            ]);
            return response()->json('You successfully applied for enrollment', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function cancelRequest() {
        try {
            $sy = DB::table('sys')->where('status',1)->get()->first();
            $user_id = Auth::user()->id;

            DB::table('enrollment')->where('sy_id',$sy->id)->where('user_id',$user_id)
                ->where('status','Pending')->delete();

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }

}
