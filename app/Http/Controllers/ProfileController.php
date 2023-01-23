<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function updateProfile() {
        try {
            $form = request()->data;
            // dd($form);
            extract($form);

            // dd($modalities);
            $modalities = json_encode($modalities);

            if(DB::table('profiles')->where('user_id', $user_id)->exists()) {
                DB::table('profiles')->where('user_id', $user_id)
                    ->update([
                        'firstname'=>$firstname,
                        'middlename'=>$middlename,
                        'lastname'=>$lastname,
                        'extname'=>$extname,
                        'gender'=>$gender,
                        'dob'=>$dob,
                        'pob'=>$pob,
                        'address'=>$address,
                        'guardian'=>$guardian,
                        'guardian_address'=>$guardian_address,
                        'gl_upon_registration'=>$gl_upon_registration,
                        'drop_reason'=>$drop_reason,
                        'attended_als'=>$attended_als,
                        'als_program'=>$als_program,
                        'literacy_level'=>$literacy_level,
                        'program_year_attended'=>$program_year_attended,
                        'program_completed'=>$program_completed,
                        'program_inc_reason'=>$program_inc_reason,
                        'modalities'=>$modalities,
                    ])
                    ;
            } else {
                DB::table('profiles')->insert([
                    'user_id'=>$user_id,
                    'firstname'=>$firstname,
                    'middlename'=>$middlename,
                    'lastname'=>$lastname,
                    'extname'=>$extname,
                    'gender'=>$gender,
                    'dob'=>$dob,
                    'pob'=>$pob,
                    'address'=>$address,
                    'guardian'=>$guardian,
                    'guardian_address'=>$guardian_address,
                    'gl_upon_registration'=>$gl_upon_registration,
                    'drop_reason'=>$drop_reason,
                    'attended_als'=>$attended_als,
                    'als_program'=>$als_program,
                    'literacy_level'=>$literacy_level,
                    'program_year_attended'=>$program_year_attended,
                    'program_completed'=>$program_completed,
                    'program_inc_reason'=>$program_inc_reason,
                    'modalities'=>$modalities,
                ]);

                // temp
                // DB::table('profiles')->where('user_id', $user_id)->update(['verified'=>1]);
            }
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function getProfile() {
        $user_id = request()->user_id ?? '';
        if($user_id=='' || $user_id=='undefined') {
            $res = DB::table('profiles')->where('user_id', auth()->user()->id)->first();
            // dd($res);
            return response()->json($res);
        } else {
            $res = DB::table('profiles')->where('user_id', $user_id)->first();
            return response()->json($res);

        }
    }
}
