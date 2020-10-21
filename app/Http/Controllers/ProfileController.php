<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile',compact('user'));
    }

    public function editProfile(Request $request)
    {   
        auth()->user()->update([
            'name' => $request->name
        ]);
        return response()->json([
            "success" => "Data Successfully Update"
        ]);
    }
}

