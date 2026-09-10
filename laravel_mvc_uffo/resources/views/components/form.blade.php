@props([
    'method' => 'get'
])
@php
    $isPost = $method !== 'get';
@endphp
<form enctype="multipart/form-data" {{$attributes->merge(['method' => $isPost ? 'post' : 'get'])}}>
    @if($isPost)
        @csrf
        @method($method)
    @endif
    {{$slot}}
</form>
