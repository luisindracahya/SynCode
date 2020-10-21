@extends('layouts.app')

@section('header')
<style>
/* WRAPPERS */
#wrapper {
  width: 100%;
  overflow-x: hidden;
}
.wrapper {
  padding: 0 20px;
}
.wrapper-content {
  padding: 20px 10px 40px;
}
#page-wrapper {
  padding: 0 15px;
  min-height: 568px;
  position: relative !important;
}
@media (min-width: 768px) {
  #page-wrapper {
    position: inherit;
    margin: 0 0 0 240px;
    min-height: 2002px;
  }
}


.message-input {
  height: 90px !important;
}
.chat-avatar {
  white: 36px;
  height: 36px;
  float: left;
  margin-right: 10px;
}
.chat-user-name {
  padding: 10px;
}
.chat-user {
  padding: 8px 10px;
  border-bottom: 1px solid #e7eaec;
}
.chat-user a {
  color: inherit;
}
.chat-view {
  z-index: 20012;
}
.chat-users,
.chat-statistic {
  margin-left: -30px;
}
@media (max-width: 992px) {
  .chat-users,
  .chat-statistic {
    margin-left: 0;
  }
}
.chat-view .ibox-content {
  padding: 0;
}
.chat-message {
  padding: 10px 20px;
}
.message-avatar {
  height: 48px;
  width: 48px;
  border: 1px solid #e7eaec;
  border-radius: 4px;
  margin-top: 1px;
}
.chat-discussion .chat-message.left .message-avatar {
  float: left;
  margin-right: 10px;
}
.chat-discussion .chat-message.right .message-avatar {
  float: right;
  margin-left: 10px;
}
.message {
  background-color: #fff;
  border: 1px solid #e7eaec;
  text-align: left;
  display: block;
  padding: 10px 20px;
  position: relative;
  border-radius: 4px;
}
.chat-discussion .chat-message.left .message-date {
  float: right;
}
.chat-discussion .chat-message.right .message-date {
  float: left;
}
.chat-discussion .chat-message.left .message {
  text-align: left;
  margin-left: 55px;
}
.chat-discussion .chat-message.right .message {
  text-align: right;
  margin-right: 55px;
}
.message-date {
  font-size: 10px;
  color: #888888;
}
.message-content {
  display: block;
}
.chat-discussion {
  background: #eee;
  padding: 15px;
  height: 400px;
  overflow-y: auto;
}
.chat-users {
  overflow-y: auto;
  height: 400px;
}
.chat-message-form .form-group {
  margin-bottom: 0;
}
.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}

.message-input {
    height: 90px !important;
}
.form-control, .single-line {
    background-color: #FFFFFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
    font-size: 14px;
}
</style>
@endsection
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
  <a href="{{route('home')}}" class="btn-warning btn glyphicon glyphicon-chevron-left"></a>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <span>Question : </span>
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="question" style="display: inline-block">
                        <div class="col-md-5">
                            <div class="card">
                                @if ($room->img_url)
                                    <div class="card-header"><img src="{{asset('storage/'.$room->img_url)}}" alt="" class="card-img-top" width="200px" height="200px"></div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body"><strong class="text">{{$room->question}}</strong></div>  
                    </div>
                </div>
                <div class="information">
                    Asked : <strong>{{$room->created_at->diffForHumans()}}</strong>, By : <strong>{{$room->user->name}}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox chat-view">
                <div class="ibox-title">
                    <small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small> Forum Panel
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-9 ">
                            <div class="chat-discussion">

                                @foreach ($room->comments as $item)
                                    @if (!auth()->user()->is($item->user))
                                        <div class="chat-message left">
                                            <img class="message-avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            <div class="message">
                                                {{-- style="background:#bef58c;" --}}
                                                <a class="message-author" href="#"> {{$item->user->name}} </a>
                                                <span class="message-date"> {{$item->created_at}}</span>
                                                <span class="message-content">
                                                    {{$item->message}}
                                                </span>
                                                <div class='mt-4'>
                                                  <button class="btn btn-outline-success btn-sm"><span class="glyphicon glyphicon-thumbs-up"></span><span class="up ml-2">40</span></button>
                                                  <button class="btn btn-outline-danger btn-sm"><span class="glyphicon glyphicon-thumbs-down"></span><span class="down ml-2">20</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="chat-message right">
                                            <img class="message-avatar" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                            <div class="message">
                                                <a class="message-author" href="#"> {{$item->user->name}} </a>
                                                <span class="message-date">  {{$item->created_at}}</span>
                                                <span class="message-content">
                                                    {{$item->message}}
                                                </span>
                                                <div class='mt-4'>
                                                  <button class="btn btn-outline-success btn-sm"><span class="glyphicon glyphicon-thumbs-up"></span><span class="up ml-2">40</span></button>
                                                  <button class="btn btn-outline-danger btn-sm"><span class="glyphicon glyphicon-thumbs-down"></span><span class="up ml-2">40</span></button>
                                                </div>
                                            </div>
                                        </div>  
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="chat-users">
                                <div class="users-list">
                                    <div class="chat-user">
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Karl Jordan</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Monica Smith</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <span class="pull-right label label-primary">Online</span>
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Michael Smith</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <span class="pull-right label label-primary">Online</span>
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Janet Smith</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Alice Smith</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Monica Cale</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Mark Jordan</a>
                                        </div>
                                    </div>
                                    <div class="chat-user">
                                        <span class="pull-right label label-primary">Online</span>
                                        <img class="chat-avatar" src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                                        <div class="chat-user-name">
                                            <a href="#">Janet Smith</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="chat-message-form">
                                <div class="form-group">
                                    <form action="{{route('room-02',$room->id)}}" method="POST">
                                      @csrf
                                        <textarea class="form-control message-input" name="message" placeholder="Enter message text and press enter"></textarea>
                                        @error('message')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <button class="btn-success btn mt-2" style="float:right;">Post</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('alert')
@endsection