<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tag;
use App\room;
use Storage;

class QuestionController extends Controller
{
    public function createQuestionIndex()
    {
        $tags = tag::all();
        return view('question',compact('tags'));
    }
    public function validation(Request $request)
    {
        $request->validate([
            'question' => 'required',
            // 'img_url' => 'required',
            'tags' => 'array|required'
        ]);
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function createQuestion(Request $request)
    {
        $this->validation($request);

        $fullpath = $request->file('img_url')->storeAs('img',"{$this->generateRandomString()}.{$request->file('img_url')->extension()}");
            
        $room = auth()->user()->rooms()->create([
            'question' => $request->question,
            'img_url'=> $fullpath,
        ]);

        $room->tags()->attach($request->tags);
        
        session()->flash('success','Question Posted');

        return redirect()->route('home');
    }

    public function editQuestionIndex(room $room)
    {
        $tags = tag::all();
        return view('edit',compact('tags','room'));
    }
    
    public function editQuestion(room $room, Request $request)
    {
        $tddhis->validation($request);

        if($request->img_url){
            Storage::delete($room->img_url);
            $fullpath = $request->file('img_url')->storeAs('img',"{$this->generateRandomString()}.{$request->file('img_url')->extension()}");
        }else{
            $fullpath = $room->img_url;
        }
        $room->update([
            'question' => $request->question,
            'img_url'=> $fullpath,
        ]);
        $room->tags()->sync($request->tags);
        session()->flash('success','Question Edited');
        return redirect()->route('home'); 
    }

    public function deleteQuestion(room $room)
    {
        Storage::delete($room->img_url);
        $room->tags()->detach();
        $room->delete();
        session()->flash('success','Question Removed');
        return redirect()->route('home'); 
    }
}
