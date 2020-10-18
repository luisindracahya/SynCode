<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\room;
use App\tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->tags){
            $rooms = room::whereHas('tags', function($q) use($request)
            {
                // $q->where('tags.id', '=', 2);
                // dd($request->all());
                $q->whereIn('tags.id', $request->tags);
                // ->where('name', 'like', 'bar%');
            })->get();
        }else{
            $rooms = room::all();
        }
        $tags = tag::all();
        return view('home',compact('rooms','tags'));
    }
}
