@extends('layouts.acaraAdminPanel')

@section('heads')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.certificates.index') }}">Certificates</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.trainingcertificates.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="no" class="text-capitalize">No</label>
                                <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat"
                                    placeholder="Certificate Number" style="color: #656773;" value="{{ old('no_sertifikat') }}"
                                    required>
                                @error('no')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-capitalize">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" style="color: #656773;" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="training" class="text-capitalize">Training</label>
                                <input type="text" class="form-control" id="training" name="training"
                                    placeholder="Training" style="color: #656773;" value="{{ old('training') }}" required>
                                @error('training')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="text-capitalize">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    placeholder="Start Date" style="color: #656773;" required>
                                @error('start_date')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="text-capitalize">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    placeholder="End Date" style="color: #656773;" required>
                                @error('end_date')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status" class="text-capitalize">Status</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    placeholder="Status" style="color: #656773;" required>
                                @error('status')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/js/plugins-init/select2-init.js') }}"></script>
@endsection
