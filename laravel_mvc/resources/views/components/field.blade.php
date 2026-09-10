@props([
    'name'
])
<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$slot}}</label>
    <input name="{{$name}}" id="{{$name}}" {{$attributes->merge([
    'type' => 'text',
    'class' => 'form-control',
])}}>
    @error($name)
    <p class="text-danger">{{$message}}</p>
    @enderror
</div>
