<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SyController extends Controller
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


    public function getSchoolYears()
    {
        $sys = DB::table('sys')->orderBy('status','desc')->get();
        return response()->json($sys);
    }

    public function edit()
    {
        $item_id = request()->item_id ?? '';
        $res = DB::table('sys')->find($item_id);
        return response()->json($res);
    }


    public function saveSchoolYear()
    {
        try {
            $data = request()->data;
            extract($data);

            $sy_existing = DB::table('sys')->where('sy', $sy)->exists();
            if($sy_existing) {
                return response()->json('Specified school year already exists', 409);
            }
            DB::table('sys')->update([
                'status'=>0
            ]);

            DB::table('sys')->insert([
                'sy'=>$sy,
                'status'=>1,
                'created_by'=>Auth::user()->id
            ]);
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update()
    {
        try {
            $data = request()->data;
            extract($data);

            DB::table('sys')->where('id', $id)
            ->update([
                'sy'=>$sy,
            ]);
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function toggleSYStatus()
    {
        try {
            $id = request()->id;
            $mode = request()->mode;

            if($mode==1) {
                // deactivate current active sy
                DB::table('sys')->where('status', 1)->update(['status'=>0]);
                //activate
                DB::table('sys')->where('id', $id)->update(['status'=>1]);
            } else {
                //deactivate
                DB::table('sys')->where('id', $id)->update(['status'=>0]);
            }

            return response()->json('Done', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function getActiveSchoolYear()
    {
        $sys = DB::table('sys')->where('status',1)->first();
        return response()->json($sys);
    }

}
