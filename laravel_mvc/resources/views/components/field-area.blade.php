@props([
    'name',
    'value' => '',
])
<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$slot}}</label>
    <textarea name="{{$name}}" class="form-control" id="{{$name}}" rows="3">{{$value}}</textarea>
    @error($name)
    <div class="text-dangere">{{$message}}</div>
    @enderror
</div>
