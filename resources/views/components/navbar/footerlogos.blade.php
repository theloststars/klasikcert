<div class="row">
    @foreach ($footerlogos as $footlogo)
    <div class="col-lg-4 col-sm-12">
        <img class="img-fluid" src="{{ Storage::disk('public')->url($footlogo->thumbnail) }}" alt="" height="160">
    </div>
    @endforeach
</div>