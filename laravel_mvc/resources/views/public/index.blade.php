<x-layout>
    <h1>Login</h1>
    <x-form action="{{route('logon')}}" method="post">
        <x-field name="username">Login</x-field>
        <x-field name="password" type="password">Password</x-field>
        <button class="btn btn-primary">Submit</button>
        @foreach($errors->all() as $message)
            <p class="text-danger">{{$message}}</p>
        @endforeach
    </x-form>
    @session('login')
    <p class="text-danger">{{$value}}</p>
    @endsession
</x-layout>
