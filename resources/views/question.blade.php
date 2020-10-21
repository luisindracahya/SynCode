@extends('layouts.app')
@section('header')
<style>
    .card{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .title{
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><div class="badge" style="font-size:20px"><span class="title">Ask Question</span></div></div>
                <form action="{{route('create_question-02')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea name="question" id="" cols="20" rows="5" class="form-control" placeholder="Question You Want To Ask"></textarea>
                        </div>
                        @error('question')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select name="tags[]" id="" class="select2 form-control" multiple>
                                @foreach ($tags as $item)
                                    <option value="{{$item->id}}">{{$item->tag_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('tags')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="img_url">Image</label>
                            <input type="file" name="img_url" id="img_url" class="form-control" accept="image/*">
                        </div>
                        @error('img_url')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection