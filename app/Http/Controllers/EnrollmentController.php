<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
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


    public function getEnrollments()
    {
        $sy_id = request()->sy_id ?? '';
        $status = request()->status ?? '';

        if($sy_id != ''){
            $classes = DB::table('enrollment')
                ->select(
                    'enrollment.*',

                    'profiles.firstname as student_firstname',
                    'profiles.middlename as student_middlename',
                    'profiles.lastname as student_lastname',

                    'programs.title as program_title',

                    'teachers.firstname as teacher_firstname',
                    'teachers.middlename as teacher_middlename',
                    'teachers.lastname as teacher_lastname',

                    'clc.name as clc_name',
                    'clc.address as clc_address',
                )
                ->join('classes','classes.id','enrollment.class_id')
                ->join('profiles','profiles.user_id','enrollment.user_id')
                ->join('programs','programs.id','classes.program_id')
                ->join('teachers','teachers.id','classes.teacher_id')
                ->join('clc','clc.id','classes.clc_id')

                ->where('classes.sy_id', $sy_id)

                ->when($status=='Pending', function($q){
                    $q->where('enrollment.status','Pending');
                })
                ->when($status=='Approved', function($q){
                    $q->where('enrollment.status','Approved');
                })

                ->latest()->get();
            return response()->json($classes);
        }
    }

    public function confirm() {
        try {
            //code...
            $data = request()->data;
            extract($data);

            // $user_id = Auth::user()->id;
            DB::table('enrollment')
                ->where('id', $enrollment_id)
                ->update([
                    'status'=>'Approved',
                    // 'created_by'=>$user_id,
                ]);
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }

}
