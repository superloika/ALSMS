<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function getStudents() {
        $clc_id = request()->clc_id;
        $program_id = request()->program_id;
        $sy_id = request()->sy_id;
        $res = DB::table('enrollment')
            ->select(
                'profiles.firstname',
                'profiles.middlename',
                'profiles.lastname',
                'profiles.gender',
                'profiles.address',
                DB::raw("CONCAT(profiles.lastname,', ',profiles.firstname,' ',profiles.middlename) as fullname"),
                DB::raw("CONCAT(teachers.lastname,', ',teachers.firstname,' ',teachers.middlename) as teacher_fullname")
            )
            ->join('profiles','profiles.user_id','enrollment.user_id')
            ->join('classes','classes.id', 'enrollment.class_id')
            ->join('teachers','teachers.id', 'classes.teacher_id')
            ->where('enrollment.sy_id', $sy_id)
            ->where('classes.clc_id', $clc_id)
            ->where('classes.program_id', $program_id)
            ->orderBy('fullname')
            ->get();
        return response()->json($res);
    }
}
