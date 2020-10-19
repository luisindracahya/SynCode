<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = feedback::all();
        return view('feedback',compact('feedback'));
    }
}
