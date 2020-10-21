@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6" style="margin:auto;">
            <div class="card">
                <div class="card-header">
                    <img src="storage/img/default.png" alt="" class="card-img-top" width="200px" height="300px">
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="" id="txtName" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="" id="txtEmail" class="form-control" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Joined</label>
                        <input type="text" name="" id="txtJoined" class="form-control" value="{{$user->created_at->diffForHumans()}}">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-sm" id="btnEdit">Edit</button>
                    <div id="updateMenu" hidden>
                        <button class="btn btn-success btn-sm" id="btnUpdate">Update</button>
                        <button class="btn btn-warning btn-sm" id="btnCancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#txtName').prop('disabled',true);
        $('#txtEmail').prop('disabled',true);
        $('#txtJoined').prop('disabled',true);
    });
    $('#btnEdit').on('click',function(){
        $('#txtName').prop('disabled',false);
        $('#btnEdit').hide();
        $('#updateMenu').prop('hidden'  ,false);
    });
    $('#btnCancel').on('click',function(){
        $('#btnEdit').show();
        $('#txtName').val("{{$user->name}}");
        $('#updateMenu').prop('hidden',true);
        $('#txtName').prop('disabled',true);
    });
    $('#btnUpdate').on('click',function(){
        Swal.fire({
            title: 'Are you sure Want To Update?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'get',
                    url : '{{route("profile-02")}}',
                    dataType : 'json',
                    data : {
                        name : $('#txtName').val()
                    },
                    success:function(response){
                        toastr.success("Success", response.message, {timeOut: 3000});
                        $('#txtName').prop('disabled',true);
                    }
                })
            }
        })
    });
</script>
@endsection