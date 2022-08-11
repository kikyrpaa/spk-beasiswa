@if ($message = Session::get('success'))
<div class="col-md-12">
    <div class="alert alert-card alert-success" role="alert">
        <strong class="text-capitalize">Success!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="col-md-12">
    <div class="alert alert-card alert-danger" role="alert">
        <strong class="text-capitalize">Error!</strong> {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
