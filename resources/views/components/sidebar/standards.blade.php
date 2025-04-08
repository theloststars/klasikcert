@foreach ($datas as $item)
    <a href="{{ route('trainings.show', $item->id) }}" class="">{{ $item->name }}</a>
@endforeach
