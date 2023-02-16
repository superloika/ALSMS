<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $programs = DB::table('programs')->orderBy('id','DESC')->get();
        return view('programs', ['programs' => $programs]);
    }

    public function view(Request $request, $slug)
    {
        $program = DB::table('programs')->where('slug', $slug)->first();
        // $programs = DB::table('programs')->get();
        return view('program_view', ['program' => $program]);
    }

    public function getPrograms()
    {
        $programs = DB::table('programs')->orderBy('id','DESC')->get();
        return response()->json($programs);
    }

    public function edit()
    {
        $programs = DB::table('programs')->find(request()->id);
        return response()->json($programs);
    }

    public function saveProgram()
    {
        try {
            $form = json_decode(request()->form);
            $files = request()->file('files');
            // extract($data);
            $slug = Str::slug($form->title);

            $program_id = DB::table('programs')->insertGetId([
                'title'=>$form->title,
                'slug'=>$slug,
                'description_short'=>$form->description_short,
                'description_long'=>$form->description_long,
                'created_by'=>Auth::user()->id
            ]);

            $attachments = [];
            if($files != null && count($files) > 0) {
                $path = "public/attachments/programs/" . $program_id. "/";
                foreach($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $attachments[] = $fileName;
                    Storage::putFileAs($path, $file, $fileName);
                }
                DB::table('programs')->where('id', $program_id)
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

    public function update()
    {
        try {
            $form = json_decode(request()->form);
            $files = request()->file('files');
            // extract($data);
            $slug = Str::slug($form->title);

            DB::table('programs')
            ->where('id', $form->id)
            ->update([
                'title'=>$form->title,
                'slug'=>$slug,
                'description_short'=>$form->description_short,
                'description_long'=>$form->description_long,
            ]);

            $attachments = [];
            if($files != null && count($files) > 0) {
                $path = "public/attachments/programs/" . $form->id. "/";
                foreach($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $attachments[] = $fileName;
                    Storage::putFileAs($path, $file, $fileName);
                }
                DB::table('programs')->where('id', $form->id)
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


    public function deleteProgram()
    {
        try {
            $id = request()->id;
            DB::table('programs')->where('id', $id)->delete();
            return response()->json('Done', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

}
