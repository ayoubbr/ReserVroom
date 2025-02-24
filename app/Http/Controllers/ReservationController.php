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
        $validated = $request->validate([
            'check_in' => 'required|date|after:now',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservations = Reservation::where('room_id', $request->room_id)
            // ->where('status', 'Accepted')
            ->orderBy('check_in', 'ASC')
            ->get();

        $date_in = str_replace('T', ' ', $request->check_in) . ':00';
        $date_out = str_replace('T', ' ', $request->check_out) . ':00';
        $counter = 0;

        if (count($reservations) > 0) {
            foreach ($reservations as $key => $reservation) {

                $date1 = date_create($date_in);
                $date2 = date_create($reservation->check_in);
                $diff = date_diff($date1,  $date2);
                $diff = $diff->format('%R');

                if ($diff == "+") {
                    $date1 = date_create($date_out);
                    $date2 = date_create($reservation->check_in);
                    $diff = date_diff($date1,  $date2);
                    $diff = $diff->format('%R');

                    if ($diff == "+") {
                        $counter++;
                    }
                }

                if ($diff == "-") {
                    $date1 = date_create($date_in);
                    $date2 = date_create($reservation->check_out);
                    $diff = date_diff($date1, targetObject: $date2);
                    $diff = $diff->format('%R');

                    if ($date_in == $reservation->check_out || $diff == "-") {
                        $counter++;
                    }
                }
            }

            if ($counter == count($reservations)) {
                $this->save($request);
            }
        } else {
            $this->save($request);
        }

        return redirect('/rooms');
    }

    private function save(Request $request)
    {
        $reservation = new Reservation();
        $reservation->room_id = $request->room_id;
        $reservation->status = 'Pending';
        $reservation->check_in = $request->check_in;
        $reservation->check_out = $request->check_out;

        $room = Room::find($request->room_id);

        $room->save();
        $reservation->save();
    }

    public function accept($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = 'Accepted';
        $room = Room::find($reservation->room_id);

        $reservation->save();
        $room->save();

        return redirect('/admin');
    }

    public function reject($id)
    {
        $reservation = Reservation::find($id);

        $reservation->status = 'Rejected';
        $room = Room::find($reservation->room_id);

        $reservation->save();
        $room->save();

        return redirect('/admin');
    }

    public function cancel($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect('/reservation/index');
    }
}
