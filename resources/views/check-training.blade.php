@extends('layouts.public')

@section('head')
@endsection
@section('content')
<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center pt-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 breadcrumb-1 pt-5">
                    <h1 class="title pt-5 text-center">Check Certificate Training</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="rts-contact-area contact-one">
    <div class="container">
            <div class="row align-items-center g-0 p-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('check.training.process') }}" class="p-5" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <h5 class="text-secondary">Name of Participant</h5>
                                            <span class="text-danger">*required</span>
                                            <input type="text" class="form-control" placeholder="Name of Participant" name="name" required />
                                            @error('company_name')
                                                <div class="alert alert-danger">{{ $message ?? 'Message' }}</div>
                                            @enderror           
                                    </div>
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <h5 class="text-secondary">Certificate Number</h5>
                                        <span class="text-danger">*required</span>
                                        <input type="text" class="form-control" placeholder="Certificate Number" name="no_sertifikat" required />
                                        @error('no')
                                            <div class="alert alert-danger">{{ $message ?? 'Message' }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3" id="captcha" style="cursor: pointer;">
                                    {!! captcha_img('math') !!}
                                </div>
                                <span class="text-danger">*fill this captcha</span>
                                <input type="text" class="form-control" placeholder="Captcha" name="captcha" required />
                                @error('captcha')
                                    <div class="alert alert-danger">{{ $message ?? 'Message' }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary w-100 p-2">
                                    Check
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="back-to-top">
            <a href="#top"><i class="ui-arrow-up"></i></a>
        </div>
    </div>


    {{-- <x-public.footer /> --}}
</div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        let captcha = document.querySelector('#captcha');
        captcha.addEventListener('click', (e) => {
            e.preventDefault();
            axios.get('/reload-captcha', ).then(res => {
                captcha.innerHTML = res.data.captcha;
            });
        });
    </script>
@endsection
