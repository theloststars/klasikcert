@foreach ($datas as $item)
<li><a class="menu-item" href="{{ route('services.show', $item->id) }}">{{$item->title}}</a></li>
                                            
@endforeach
