<script type="text/javascript">
    if("{{Session::has('success')}}"){
        toastr.success("Success", "{{Session::get('success')}}", {timeOut: 5000})
    }
</script>