@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close pt-3" data-dismiss="alert" aria-hidden="true">×</button>
        {{-- <h5><i class="icon fas fa-check"></i> Alert!</h5> --}}
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close pt-3" data-dismiss="alert" aria-hidden="true">×</button>
        {{-- <h5><i class="icon fas fa-check"></i> Alert!</h5> --}}
        {{ session('warning') }}
    </div>
@endif
