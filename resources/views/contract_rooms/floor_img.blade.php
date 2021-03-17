@if($floor)
    <img id="image" class="mx-auto" src="{{ asset($floor['image_url']) }}" alt="{{ $floor['name'] }}">
@endif