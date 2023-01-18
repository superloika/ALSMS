<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function saveProgram()
    {
        try {
            $data = request()->data;
            extract($data);
            $slug = Str::slug($title);

            DB::table('programs')->insert([
                'title'=>$title,
                'slug'=>$slug,
                'description_short'=>$description_short,
                'description_long'=>$description_long,
                'created_by'=>Auth::user()->id
            ]);
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
