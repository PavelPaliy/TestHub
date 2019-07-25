@extends('layouts.app')

@section('title', $test->name )

@section('content')
    <h1>{{ $test->name }}</h1>
    @if($test->intro!=null)
        <p>{{ $test->intro }}</p>
    @endif
    <p>Чтобы успешкно пройти тест нужно набрать {{ $test->minScore }} баллов. Время прохождения теста {{ $test->time }} минут.</p>
    <form action="{{ route('test.pass', $test->id) }}" method="get">
        <input type="submit" value="Пройти тест">
    </form>
@endsection