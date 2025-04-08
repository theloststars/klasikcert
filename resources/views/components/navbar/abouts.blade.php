@foreach ($datas  as $item)
<li><a class="menu-item" href="{{ route('abouts.show', $item->id) }}">{{$item->title}}</a></li>                             
@endforeach
