<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function show($id)
    {
        $room = Room::find($id);
        return view('rooms.show', compact('room'));
    }

    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }
    
    public function store(Request $request)
    {
        $room = new Room();
        // dd($request);
        $room->title = $request['title'];
        $room->description = $request['description'];
        $room->seats = $request['seats'];
        $room->status = 'Available';
        $room->city = $request['city'];
        $room->price = $request['price'];
        $room->rating = 0;
        $room->photo = $request['photo'];

        $room->save();

        return redirect('/rooms');
    }

    public function delete($id)
    {
        $room = Room::find($id);

        $room->delete();

        return redirect('/admin');
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        // dd($request, $id);
        $room = Room::find($id);
        $room->title = $request->input('title');
        $room->description = $request->input('description');
        $room->city = $request->input('city');
        $room->price = $request->input('price');
        $room->status = $request->input('status');
        $room->seats = $request->input('seats');
        $room->photo = $request->input('photo');

        $room->save();
        return redirect(route('admin.dashboard'));
    }

    public function admin()
    {
        $rooms = Room::all();
        $reservations = Reservation::all();
        return view('admin.dashboard', compact('rooms', 'reservations'));
    }
}
