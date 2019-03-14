@if (Session::has('success'))
    <div class="alert alert-success alert-dismissable no-margin">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-check"></i> {{ Session::get('success') }}
    </div>
@endif