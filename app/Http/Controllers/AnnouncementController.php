<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
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
        return view('announcements');
    }

    public function getAnnouncements() {
        $class_id = request()->class_id ?? '';
        $res = DB::table('announcements')->where('class_id',$class_id)->orderBy('id','DESC')->get();
        return response()->json($res);
    }

    public function saveAnnouncement() {
        $class_id = request()->class_id ?? '';
        $message = request()->message ?? '';
        DB::table('announcements')->insert([
            'class_id' => $class_id,
            'message' => $message,
        ]);
        return response()->json('Done');
    }

    public function deleteAnnouncement() {
        $announcement_id = request()->announcement_id ?? '';
        DB::table('announcements')->where('id',$announcement_id)->delete();
        return response()->json('Done');
    }

}
