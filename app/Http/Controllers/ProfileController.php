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
                ]);
            }
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function getProfile() {
        $res = DB::table('profiles')->where('user_id', auth()->user()->id)->first();
        // dd($res);
        return response()->json($res);
    }
}
