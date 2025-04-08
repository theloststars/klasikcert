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
                        <form action="{{ route('admin.certificates.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="no" class="text-capitalize">No</label>
                                <input type="text" class="form-control" id="no" name="no"
                                    placeholder="Certificate Number" style="color: #656773;" value="{{ old('no') }}"
                                    required>
                                @error('no')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_name" class="text-capitalize">Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    placeholder="Company Name" style="color: #656773;" value="{{ old('company_name') }}"
                                    required>
                                @error('company_name')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="training" class="text-capitalize">Standard</label>
                                <input type="text" class="form-control" id="training" name="training"
                                    placeholder="Training" style="color: #656773;" value="{{ old('training') }}" required>
                                @error('training')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="scope" class="text-capitalize">Scope</label>
                                <input type="text" class="form-control" id="scope" name="scope" placeholder="Scope"
                                    style="color: #656773;" value="{{ old('scope') }}" required>
                                @error('scope')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>  --}}
                            <div class="form-group">
                                <label for="issue_date" class="text-capitalize">Issue Date</label>
                                <input type="date" class="form-control" id="issue_date" name="issue_date"
                                    placeholder="Issue Date" style="color: #656773;" required>
                                @error('issue_date')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="expiry_date" class="text-capitalize">Expiry Date</label>
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                    placeholder="Expiry Date" style="color: #656773;" required>
                                @error('expiry_date')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="certification_body" class="text-capitalize">Certification Body</label>
                                <input type="text" class="form-control" id="certification_body" name="certification_body"
                                    placeholder="Certification Body" style="color: #656773;" required>
                                @error('expiry_date')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="status" class="text-capitalize">Status</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    placeholder="Status" style="color: #656773;" required>
                                @error('status')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="location" class="text-capitalize">Location</label>
                                <input type="text" class="form-control" id="location" name="location"
                                    placeholder="Location" style="color: #656773;" value="{{ old('location') }}" required>
                                @error('location')
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
