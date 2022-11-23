<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $programs = DB::table('programs')->get();
        return view('programs', ['programs' => $programs]);
    }

    public function view(Request $request, $slug)
    {
        $program = DB::table('programs')->where('slug', $slug)->first();
        // $programs = DB::table('programs')->get();
        return view('program_view', ['program' => $program]);
    }

}
