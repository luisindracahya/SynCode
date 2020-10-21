<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\room;

class RoomController extends Controller
{
    public function index(room $room)
    {
        return view('room',compact('room'));
    }
    public function validation(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);
    }
    public function post(Request $request, $roomId)    
    {
        $this->validation($request);

        $comment = auth()->user()->comments()->create([
            'message' => $request->message,
            'room_id'=> $roomId,
        ]);

        session()->flash('success','Comment Posted');

        return redirect()->route('room-01',$roomId);
    }
}
