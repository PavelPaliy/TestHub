@extends('layouts.app')

@section('title', $test->name )

@section('content')
    <h1>{{ $test->name }}</h1>
    @if(Auth::user())
        <p>На ваш email {{ Auth::user()->email }} выслана информация про тест.</p>
    @else
        <p>Введите email, на который будет выслана информация про тест.</p>
        <form action = '{{ route('test.email') }}' method="POST">
            {{csrf_field()}}
            <div class = "form-group">
                <label>Email</label><input type ="email" class="text form-control" name="email">
            </div>
            <button class="btn btn-success" type="submit">Отправить</button>
        </form>
    @endif
@endsection