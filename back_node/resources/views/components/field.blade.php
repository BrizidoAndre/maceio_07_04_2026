@props([
    'name',
])
<div class="mb-3">
    <label for="{{$name}}}" class="form-label">{{$slot}}</label>
    <input id="{{$name}}}" {{$attributes->merge(['class' => 'form-control', 'type' => 'text'])}} name="{{$name}}">
    @error($name)
    <div class="text-danger">{{$message}}</div>
    @enderror
</div>
