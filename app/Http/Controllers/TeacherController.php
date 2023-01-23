<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
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


    public function getTeachers()
    {
        $sys = DB::table('teachers')->latest()->get();
        return response()->json($sys);
    }


    public function saveTeacher()
    {
        try {
            $data = request()->data;
            extract($data);

            $teacher_id = DB::table('teachers')->insertGetId([
                'firstname'=>$firstname,
                'middlename'=>$middlename,
                'lastname'=>$lastname,
                'gender'=>$gender,
                'address'=>$address,
                'created_by'=>Auth::user()->id
            ]);

            // create user account for teacher
            DB::table('users')->insert([
                'name'=>"$firstname $middlename $lastname",
                'username'=>Str::lower($firstname). Str::lower($lastname),
                'password'=>Hash::make('123'),
                'user_type'=>'teacher',
                'teacher_id'=>$teacher_id,
            ]);

            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function deleteTeacher()
    {
        try {
            $id = request()->id;
            DB::table('teachers')->where('id', $id)->delete();
            return response()->json('Done', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


}
