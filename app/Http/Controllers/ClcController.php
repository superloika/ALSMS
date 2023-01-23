<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClcController extends Controller
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

    public function getClcs()
    {
        $clcs = DB::table('clc')->orderBy('id','DESC')->get();
        return response()->json($clcs);
    }

    public function saveClc()
    {
        try {
            $data = request()->data;
            extract($data);

            DB::table('clc')->insert([
                'name'=>$name,
                'address'=>$address,
            ]);
            return response()->json('Success', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function deleteClc()
    {
        try {
            $id = request()->id;
            DB::table('clc')->where('id', $id)->delete();
            return response()->json('Done', 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

}
