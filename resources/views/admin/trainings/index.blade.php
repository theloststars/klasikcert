@extends('layouts.acaraAdminPanel')

@section('heads')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <x-acara.alerts />
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li> --}}
                <li class="breadcrumb-item active"><a href="javascript:void(0)">News / Blogs</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.trainings.update.2') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="text-capitalize">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                    style="color: #656773;" value="{{ $training->title }}" required>
                                @error('title')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customFile">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" accept="image/*"
                                        name="image">
                                    <label class="custom-file-label text-truncate"
                                        for="customFile">{{ $training->image ?? 'Choose' }}</label>
                                </div>
                            </div>
                            @error('image')
                                <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="description" class="text-capitalize">description</label>
                                <textarea name="description" id="description" rows="10" class="form-control" style="color: #656773;">{!! $training->description ?? '' !!}</textarea>
                                @error('description')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {

                licenseKey: '',



            })
            .then(editor => {
                window.editor = editor;




            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: 8ubb9kaqv8bd-mk6bg6wswnw1');
                console.error(error);
            });
    </script>
@endsection
