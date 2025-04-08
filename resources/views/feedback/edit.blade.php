@extends('layouts.acaraAdminPanel')

@section('heads')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.feedback.update', $feedback->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Client Name" style="color: #656773;" value="{{ $feedback->name }}"
                                    required>
                                @error('name')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="position" class="text-capitalize">Position</label>
                                <input type="text" class="form-control" id="position" name="position"
                                    placeholder="Client position" style="color: #656773;" value="{{ $feedback->position }}"
                                    required>
                                @error('position')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customFIle" class="text-capitalize">Photo *optional</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" accept="image/*"
                                        name="image">
                                    <label class="custom-file-label text-truncate" for="customFile">Choose</label>
                                </div>
                            </div>
                            @error('image')
                                <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="feedback" class="text-capitalize">Feedback</label>
                                <textarea name="feedback" id="feedback" rows="10" class="form-control" required style="color: #656773;">{!! @$feedback->feedback ?? 'Feedback' !!}</textarea>
                                @error('feedback')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
