<x-layout title="Login">
    @if (session()->has('error'))
        <p class="alert">{{session('error')}}</p>
    @endif
    <form action="/login" method="POST">
        @csrf

        <div>
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="{{old('email')}}">
            <ul class="input-error">
                @foreach ($errors->get('email') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password" minlength="8">
            <ul class="input-error">
                @foreach ($errors->get('password') as $message)
                    <li class="input-error">{!! $message !!}</li>
                @endforeach
            </ul>
        </div>

        <input type="submit" value="Log In">
    </form>
</x-layout>
