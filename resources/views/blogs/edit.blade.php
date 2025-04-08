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
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.trainings.index') }}">Blogs or News</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title" class="text-capitalize">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Training Name" style="color: #656773;" value="{{ $blog->title ?? '' }}"
                                    required>
                                @error('title')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="title" class="text-capitalize">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Training title" style="color: #656773;" required>
                                @error('title')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="body" class="text-capitalize">Content</label>
                                <textarea name="body" id="body" rows="10" class="form-control">{!! $blog->body ?? 'Content' !!}</textarea>
                                @error('body')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="text-capitalize">Short Description</label>
                                <textarea name="short_description" id="short_description" rows="10" class="form-control" style="color: #656773;">{{ @$blog->short_description }}</textarea>
                                @error('short_description')
                                    <div class="text-sm text-danger">{{ $message ?? 'Something error' }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Thumbnail *optional</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" accept="image/*"
                                        name="thumbnail">
                                    <label class="custom-file-label text-truncate" for="customFile">Choose</label>
                                </div>
                                @error('thumbnail')
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
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('acaraAdminPanel/xhtml/js/plugins-init/select2-init.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {

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
