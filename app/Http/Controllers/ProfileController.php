<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile() {
        try {
            $files = request()->file('files');
            $form = json_decode(request()->form);
            // dd(implode($form->modalities));
            $modalities = $form->modalities;
            // $modalities = (is_array($modalities)==1) ? implode($modalities) : $modalities;
            $modalities = json_encode($modalities);

            if(DB::table('profiles')->where('user_id', $form->user_id)->exists()) {
                DB::table('profiles')->where('user_id', $form->user_id)
                    ->update([
                        'firstname'=>$form->firstname,
                        'middlename'=>$form->middlename,
                        'lastname'=>$form->lastname,
                        'extname'=>$form->extname,
                        'gender'=>$form->gender,
                        'dob'=>$form->dob,
                        'pob'=>$form->pob,
                        'address'=>$form->address,
                        'guardian'=>$form->guardian,
                        'guardian_address'=>$form->guardian_address,
                        'fb_account'=>$form->fb_account,
                        'gl_upon_registration'=>$form->gl_upon_registration,
                        'drop_reason'=>$form->drop_reason,
                        'attended_als'=>$form->attended_als,
                        'als_program'=>$form->als_program,
                        'literacy_level'=>$form->literacy_level,
                        'program_year_attended'=>$form->program_year_attended,
                        'program_completed'=>$form->program_completed,
                        'program_inc_reason'=>$form->program_inc_reason,
                        'modalities'=>$modalities,
                    ])
                    ;
            } else {
                DB::table('profiles')->insert([
                    'user_id'=>$form->user_id,
                    'firstname'=>$form->firstname,
                    'middlename'=>$form->middlename,
                    'lastname'=>$form->lastname,
                    'extname'=>$form->extname,
                    'gender'=>$form->gender,
                    'dob'=>$form->dob,
                    'pob'=>$form->pob,
                    'address'=>$form->address,
                    'guardian'=>$form->guardian,
                    'guardian_address'=>$form->guardian_address,
                    'fb_account'=>$form->fb_account,
                    'gl_upon_registration'=>$form->gl_upon_registration,
                    'drop_reason'=>$form->drop_reason,
                    'attended_als'=>$form->attended_als,
                    'als_program'=>$form->als_program,
                    'literacy_level'=>$form->literacy_level,
                    'program_year_attended'=>$form->program_year_attended,
                    'program_completed'=>$form->program_completed,
                    'program_inc_reason'=>$form->program_inc_reason,
                    'modalities'=>$modalities,
                ]);

                // temp
                // DB::table('profiles')->where('user_id', $user_id)->update(['verified'=>1]);
            }

            $attachments = [];
            if($files != null && count($files) > 0) {
                $path = "public/attachments/" . $form->user_id. "/";
                foreach($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $attachments[] = $fileName;
                    Storage::putFileAs($path, $file, $fileName);
                }
                DB::table('profiles')->where('user_id', $form->user_id)
                    ->update([
                        'attachments'=>$attachments,
                    ])
                    ;
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
