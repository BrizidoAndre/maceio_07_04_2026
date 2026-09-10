@props([
    'name'
])
<div class="input-group mb-3">
    <label class="input-group-text" for="{{$name}}">{{$slot}}</label>
    <input type="file" class="form-control" id="{{$name}}" name="{{$name}}">
</div>
