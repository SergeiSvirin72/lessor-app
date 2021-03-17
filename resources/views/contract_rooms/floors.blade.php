<option value="">Выберите этаж</option>
@foreach($floors as $floor)
    <option value="{{$floor->id}}">
        {{$floor->name}}
    </option>
@endforeach