@props([
    'method' =>'get',
    'action' => ''
])
@php
    $shouldBePost = $method !== 'get';
@endphp
<form {{$attributes->merge(['action' => $action])}} method="{{$shouldBePost ? 'post': 'get'}}"
      enctype="multipart/form-data">
    @if($shouldBePost)
        @csrf
        @method($method)
    @endif
    {{$slot}}
</form>
