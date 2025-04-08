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
                        Certificate
                    </h2>
                    <div class="card w-75 rounded-0 border-0 mx-auto tw-shadow-xl" style="border-radius: 20px;">
                        <div class="card-body bg-color-2 tw-rounded-lg p-5" style="border-radius: 20px;">
                            <table class="table table-borderless rounded-lg" style="border-radius: 20px;">
                                <tbody style="border-radius: 20px;">
                                    <tr class="bg-white">
                                        <td class="text-black"><b>Certificate No</b></td>
                                        <td class="text-black"><b> : </b> </td>
                                        <td class="text-black"><b> {{ $certificate->no }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black"><b>Name </b> </td>
                                        <td class="text-black">:</td>
                                        <td class="text-black"><b> {{ $certificate->company_name }}</b> </td>
                                    </tr>
                                    <tr class="bg-white">
                                        <td class="text-black"><b>Location </b> </td>
                                        <td class="text-black">:</td>
                                        <td class="text-black"><b> {{ $certificate->location }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black"><b>Standart </b> </td>
                                        <td class="text-black">:</td>
                                        <td class="text-black"><b> {{ @$certificate->training ?? '-' }}</b> </td>
                                    </tr>
                                    {{-- <tr class="bg-white">
                                        <td class="text-black"><b>Scope</b></td>
                                        <td class="text-black">:</td>
                                        <td class="text-black"><b> {{ $certificate->scope }}</b> </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black"><b>Certification Body </b> </td>
                                        <td class="text-black">:</td>
                                        <td style="word-break: break-all;"><b>{{ $certificate->certification_body }}</b></td>
                                    </tr> 
                                </tbody> --}}
                            </table>
    
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-around pt-lg-2 w-75">
                                <div class="d-flex align-items-center gap-3 mb-2" style="gap: 1rem;">
                                    <b class="m-0 text-black">Issue Date</b>
                                    <span
                                        class="bg-white text-black py-2 px-4 rounded-3">{{ \Carbon\Carbon::parse($certificate->issue_date)->format('d F Y') }}</span>
                                </div>
    
                                <div class="d-flex align-items-center gap-3 mb-2" style="gap: 1rem;">
                                    <b class="m-0 text-black">Expiry Date</b>
                                    <span
                                        class="bg-white text-black py-2 px-4 rounded-3">{{ \Carbon\Carbon::parse($certificate->expiry_date)->format('d F Y') }}</span>
                                </div>
    
                                 <div class="d-flex align-items-center gap-3 mb-2" style="gap: 1rem;">
                                    <b class="m-0 text-black">Status</b>
                                    
                                        @if ($certificate->issue_date <= $certificate->expiry_date)
                                        <span class="bg-white py-2 px-4 rounded-3">
                                        <b class="text-success"> Valid </b>
                                        </span>
                                        @else
                                        <span class="bg-white py-2 px-4 rounded-3">
                                            <b class="text-danger"> Expired </b>
                                        </span>
                                        @endif
                                    
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
