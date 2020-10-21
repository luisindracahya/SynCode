@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($feedback as $item)
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-header"><strong>From : </strong>{{$item->user->name}}</div>
                <div class="card-body"><strong>Message : </strong>{{$item->message}}</div>
                <div class="card-footer"></div>
            </div>
        </div>
    @endforeach
</div>
@endsection
