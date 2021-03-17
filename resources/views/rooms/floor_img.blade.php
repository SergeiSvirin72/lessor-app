@if($floor)
    <img id="image"
         src="{{ asset($floor['image_url']) }}" alt="{{ $floor['name'] }}">
@endif