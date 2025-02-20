<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::with('room')
            ->orderBy('check_in', 'desc')
            ->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create($id)
    {
        $room = Room::find($id);
        return view('reservations.create', compact('room'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $validated = $request->validate([
        //     'check_in' => 'required|date|after:now',
        //     'check_out' => 'required|date|after:check_in',
        // ]);
        $reservation = new Reservation();
        $reservation->room_id = $request->room_id;
        $reservation->status = 'Pending';
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;

        $room = Room::find($request->room_id);
        $room->status = 'Pending reservation';
        $room->save();
        $reservation->save();

        // dd($room, $reservation);
        return redirect('/rooms');
    }

    public function accept($id)
    {
        $reservation = Reservation::find($id);
        // dd($reservation);
        $reservation->status = 'Accepted';
        $room = Room::find($reservation->room_id);
        // dd($room);
        $room->status = 'Booked';

        $reservation->save();
        $room->save();

        return redirect('/admin');
    }

    public function reject($id)
    {
        $reservation = Reservation::find($id);
        // dd($reservation);
        $reservation->status = 'Rejected';
        $room = Room::find($reservation->room_id);
        // dd($room);
        $room->status = 'Available';

        $reservation->save();
        $room->save();

        return redirect('/admin');
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        $room = Room::find($reservation->room_id);
        $reservation->delete();
        $room->status = 'Available';
        $room->save();

        return redirect('/reservation/index');
    }
}
