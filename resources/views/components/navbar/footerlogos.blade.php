{{-- <div class="row">
    @foreach ($footerlogos as $footlogo)
    <div class="col-lg-4 col-sm-12">
        <img class="img-fluid" src="{{ Storage::disk('public')->url($footlogo->thumbnail) }}" alt="" height="160">
    </div>
    @endforeach
</div> --}} 

@foreach ($datas as $item)
<li><a class="menu-item" href="{{ route('services.show', $item->id) }}">{{$item->title}}</a></li>
                                            
@endforeach
