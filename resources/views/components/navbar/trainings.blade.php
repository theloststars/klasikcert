@foreach ($datas as $item)
    <li><a href="{{ route('trainings.show', $item->id) }}">{{ $item->name }}</a></li>
    {{-- <li><a class="dropdown-item" href="{{ route('trainings.show', $item->id) }}">{{ $item->name }}</a></li> --}}
@endforeach
