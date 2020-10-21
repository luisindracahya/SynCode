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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="badge" style="font-size:20px"><span class="title">Edit Question</span></div>
                </div>
                <form action="{{route("edit_question-04",$room->id)}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea name="question" id="" cols="20" rows="5" class="form-control" placeholder="Question You Want To Ask">{{$room->question}}</textarea>
                        </div>
                        @error('question')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select name="tags[]" id="tags" class="select2 form-control" multiple>
                                @foreach ($tags as $tag)
                                    <?php $flag = 1?>
                                    @foreach($room->tags as $item)
                                        @if($tag->id==$item->id)
                                            <?php $flag=0 ?>
                                        @endif
                                    @endforeach
                                    @if($flag==0)
                                        <option value="{{$tag->id}}" selected>{{$tag->tag_name}}</option>
                                    @else
                                        <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tags')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div style="width:200px;height:200px;">
                                <img src="{{asset('storage/'.$room->img_url)}}" alt="Image Not Found" class="card-img-top" width="200px" height="200px">
                            </div>
                            <label for="img_url">Change Image</label>
                            <input type="file" name="img_url" id="img_url" class="form-control" accept="image/*">
                            @error('img_url')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection