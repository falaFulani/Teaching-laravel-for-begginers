<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $rooms = DB::table('rooms')->get();
        if ($request->query('id') !== null){
            $rooms = $rooms->where('room_type_id', $request->query('id'));
        }

       // return response()->json($rooms);
        return view('Rooms.index', ['rooms'=>$rooms]);
    }
}
