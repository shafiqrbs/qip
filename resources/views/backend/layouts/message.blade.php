@if($message = Session::get('message'))
    <div class="alert alert-primary" role="alert">
        <strong>{{$message }}</strong>
    </div>
@endif

@if($validate = Session::get('validate'))
    <div class="alert alert-warning" role="alert">
        <strong>{{$validate }}</strong>
    </div>
@endif

@if($delete = Session::get('delete'))
    <div class="alert alert-danger" role="alert">
        <strong>{{$delete }}</strong>
    </div>
@endif
