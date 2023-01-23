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
    }


    public function all()
    {
        // dd(request()->sy_id);

        $sy_id = request()->sy_id ?? '';
        if($sy_id != ''){
            $classes = DB::table('classes')
                ->select(
                    'classes.*',
                    'enrollment.user_id',
                    'enrollment.status',
                    'programs.title as program_title',
                    'teachers.firstname',
                    'teachers.middlename',
                    'teachers.lastname',
                    'profiles.verified',
                    'clc.name as clc_name',
                    'clc.address as clc_address',
                )
                ->leftJoin('enrollment','enrollment.class_id','classes.id')
                ->leftJoin('profiles','profiles.user_id','enrollment.user_id')
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->join('clc','clc.id','classes.clc_id')
                ->where('classes.sy_id', $sy_id)
                ->orWhere('enrollment.user_id', Auth::user()->id)
                ->orderBy('id','desc')->get();

            return response()->json($classes);
        }
    }

    public function enroll() {
        try {
            //code...
            $data = request()->data;
            extract($data);
            $user_id = Auth::user()->id;
            $sy_id = DB::table('sys')->where('status',1)->get()->first();

            if(DB::table('enrollment')->where([
                'user_id'=>$user_id,
                'class_id'=>$class_id,
                'status'=>'Pending'
            ])->exists()){
                return response()->json('You already applied for enrollment on this program. Check in PENDING tab', 409);
            } else if (
                DB::table('enrollment')->where([
                    'user_id'=>$user_id,
                    'class_id'=>$class_id,
                    'status'=>'Approved'
                ])->exists()
            ) {
                return response()->json('You are already enrolled on this program. Check in ENROLLED tab', 409);
            }

            DB::table('enrollment')->insert([
                'user_id'=>$user_id,
                'class_id'=>$class_id,
                'created_by'=>$user_id,
            ]);
            return response()->json('You successfully applied for enrollment on this program. Check in PENDING tab', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }

    public function cancelRequest() {
        try {
            //code...
            $data = request()->data;
            extract($data);
            $user_id = Auth::user()->id;

            DB::table('enrollment')->where('class_id',$class_id)->where('user_id',$user_id)
                ->where('status','Pending')->delete();

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }

}
