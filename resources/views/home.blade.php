@extends('layouts.app')

@section('header')
<style>
    /* body { padding-top:30px; } */
    .widget .panel-body { padding:0px; }
    .widget .list-group { margin-bottom: 0; }
    .widget .panel-title { display:inline }
    .widget .label-info { float: right; }
    .widget li.list-group-item {border-radius: 0;border: 0;border-top: 1px solid #ddd;}
    .widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
    .widget .mic-info { color: #666666;font-size: 11px; }
    .widget .action { margin-top:5px; }
    .widget .comment-text { font-size: 12px; }
    .widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }
    a:hover{
        text-decoration: none;
        font-weight: bold;
    }
    .select2-selection.select2-selection--multiple {
        width: 260px;
    }
    #search{
        margin-left: 100px;
    }
    #modal_center{
        margin-left: -220px;
    }
    /* CSS used here will be applied after bootstrap.css */
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-0 mb-2">
            <label for="">Search Question By Tag</label>
            <div class="justify-content-between d-flex col-md-12 p-0">
                <div class="col-md-5 p-0 d-flex">
                   <form action="{{route('home')}}" method="GET">
                        <select name="tags[]" id="tags" class="select2 form-control"  multiple>
                            @foreach ($tags as $item)
                                <option value="{{$item->id}}">{{$item->tag_name}}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success" id="search">Search</button>
                   </form>
                </div>
                <a class="btn btn-primary" href="{{route('create_question-01')}}">Ask Question</a>
            </div>
        </div>
        <div class="panel panel-default widget" style="width:100%">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title"></h3>
                <span class="label label-info"></span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach ($rooms as $item)
                        <li class="list-group-item">    
                            <div class="row">
                                <div class="col-xs-2 col-md-1">
                                    <a onclick="zoomImg('{{$item->img_url}}','{{$item->question}}','{{$item->user->name}}')" style="cursor: pointer;"><img src="storage/{{$item->img_url}}" class="img-circle img-responsive" alt="" /></div></a>
                                <div class="col-xs-10 col-md-11">
                                    <div>
                                        <a href="{{route('room-01',$item->id)}}">
                                            {{\Illuminate\Support\Str::limit($item->question, $limit = 100, $end = '...')}}
                                        </a>
                                        <div class="mic-info">
                                            By: <a href="#">{{$item->user->name}}</a> on 2 Aug 2013
                                        </div>
                                    </div>
                                    <div class="comment-text">
                                        <?php $count=0; ?>
                                        @foreach ($item->tags as $tag)
                                            @if ($count%2==0)
                                                <div class="badge bg-warning" style="color:black;">{{$tag->tag_name}}</div>
                                            @else 
                                                <div class="badge bg-success">{{$tag->tag_name}}</div>
                                            @endif
                                            <?php $count++; ?>
                                        @endforeach
                                    </div>
                                    <div class="action">
                                        @if (auth()->user()->is($item->user))
                                            <a href="{{route('edit_question-03',$item->id)}}" class="btn btn-primary btn-xs" title="Edit">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <button type="button" class="btn btn-success btn-xs" title="Approved">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                            <form id='form-delete-question' action="{{route('delete_question-05',$item->id)}}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-danger btn-xs" title="Delete" onclick="deleteConfirmation()">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
            </div>
        </div>
    </div>
</div>
<div style="position:fixed;bottom:0;right:0;border-radius:5px;cursor:pointer;" class="bg-primary m-2 p-3" data-toggle="modal" data-target="#exampleModalCenter">
    <span class="text-white">Feedback</span>
    <span class="glyphicon glyphicon-envelope text-white"></span>
</div>  
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" id="modal_center">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Feedback</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id='form-feedback' action="{{route('home-01')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header"></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="feedback">Message For Us</label>
                                <textarea name="feedback" id="feedback" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    <a class="btn btn-success btn-sm" id="sendFeedback">Submit</a>
                </div>
            </form>
        </div>
    </div>
  </div>
@include('alert')
@endsection

@section('js')
<script>
    function deleteConfirmation(){
        Swal.fire({
            title: 'Are you sure Want To Delete?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form-delete-question').submit();
            }
        })
    }
    function zoomImg(url,question,byusername){
        Swal.fire({
            title: byusername,
            text: question,
            imageUrl: '/storage/'+url,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Image Not Found',
        })
    }
    $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    })
    $('#sendFeedback').on('click', function (e) {
        if($('#feedback').val()==""){
            Swal.fire({
                title: 'Message Cannot Be Empty',
                icon:'error',
                width: 600,
                padding: '3em',
            })
            return false;
        }
        $('#form-feedback').submit();
    })
</script>
@endsection






