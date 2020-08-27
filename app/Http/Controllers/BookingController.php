<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('bookings')->get();
       return view('bookings.index')
        ->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms= DB::table('rooms')->get()->pluck('number','id')->prepend('Select a room');
        $users= DB::table('users')->get()->pluck('name','id')->prepend('select user');
        return view('bookings.create')
            ->with('rooms', $rooms)
        ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $id = DB::table('bookings')->insertGetId([
            'room_id'=> $request->input('room_id'),
            'start'=> $request->input('start'),
            'end'=> $request->input('end'),
            'is_reservation'=> $request->input('is_reservation', false),
            'is_paid'=> $request->input('is_paid', false),
            'notes'=> $request->input('notes'),
        ]);
        DB::table('bookings_users')->insert([
            'booking_id'=>$id,
        'user_id' => $request->input('user_id')
        ]);
 return redirect()->action('BookingController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //dd($booking);

        return view('bookings.show',['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $rooms= DB::table('rooms')->get()->pluck('number','id')->prepend('Select a room');
        $users= DB::table('users')->get()->pluck('name','id')->prepend('select user');
        $bookingUser = DB::table('booking_users')->where('booking_id',$booking->id)->first();
        return view('bookings.edit')
            ->with('rooms', $rooms)
            ->with('bookingUser', $bookingUser)
            ->with('booking', $booking)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
