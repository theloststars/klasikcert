@extends('layouts.public')

@section('head')
@endsection

@section('content')
    <div>
        <div class="triangle-wrap">
            <div class="triange"></div>
        </div>
    
        <div class="content-wrapper pt-5">
            <section id="check-certificate-result" class="py-5">
                <div class="container box-shadow p-4 pt-5" style="border-radius: 5px;">
                    <h2 class="pt-5 text-center">
                        Training Certificate
                    </h2>
                    <div class="card w-75 rounded-0 border-0 mx-auto tw-shadow-xl" style="border-radius: 20px;">
                        <div class="card-body bg-color-2 tw-rounded-lg p-5" style="border-radius: 20px;">
                            <table class="table table-borderless rounded-lg bg-white" style="border-radius: 20px !important;">
                                <tbody style="border-radius: 20px;">
                                    <tr>
                                        <td class="text-black p-3"><h4>Certificate No</h4></td>
                                        <td class="text-black p-3"><h4> : </h4> </td>
                                        <td class="text-black p-3"><h4> {{ $training->no_sertifikat }}</h4> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black p-3"><h4>Name </h4> </td>
                                        <td class="text-black p-3"><h4>:</h4></td>
                                        <td class="text-black p-3"><h4> {{ $training->name }}</h4> </td>
                                    </tr>   
                                    <tr>
                                        <td class="text-black p-3">
                                            <h4>Standart </h4> 
                                        </td>
                                        <td class="text-black p-3">
                                            <h4>:</h4>
                                        </td>
                                        <td class="text-black p-3">
                                            <h4> {{ @$training->training ?? '-' }}</h4> 
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td class="text-black"><b>Scope</b></td>
                                        <td class="text-black">:</td>
                                        <td class="text-black"><b> {{ $training->scope }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black"><b>Certification Body </b> </td>
                                        <td class="text-black">:</td>
                                        <td style="word-break: break-all;"><b>{{ $training->certification_body }}</b></td>
                                    </tr>  --}}
                                </tbody>
                            </table>
    
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-around pt-lg-2 w-75">
                                <div class="d-flex align-items-center gap-4 mb-2 p-3" style="gap: 1rem;">
                                    <h5 class="m-0 text-black">Start Training Date</h6>
                                    <span
                                        class="bg-white text-black py-2 px-4 rounded-3">{{ \Carbon\Carbon::parse($training->issue_date)->format('d F Y') }}</span>
                                </div>
    
                                <div class="d-flex align-items-center gap-4 mb-2" style="gap: 1rem;">
                                    <h5 class="m-0 text-black">End Training Date</h6>
                                    <span
                                        class="bg-white text-black py-2 px-4 rounded-3">{{ \Carbon\Carbon::parse($training->expiry_date)->format('d F Y') }}</span>
                                </div>
                                <br>
                                 <div class="d-flex align-items-center gap-4 mb-2" style="gap: 1rem;">
                                    <h5 class="m-0 text-black">Status</h6>
                                    <span class="bg-white py-2 px-4 rounded-3">
                                        <b class="text-success"> {{$training->status}} </b>
                                    </span>
                                </div> 
                            </div>
    
                        </div>
                    </div>
                </div>
            </section>
    
            <!-- footer : start -->
            {{-- <x-public.contactus /> --}}
            {{-- <x-public.footer /> --}}
            <!-- footer : end -->
    
            <div id="back-to-top">
                <a href="#top"><i class="ui-arrow-up"></i></a>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
