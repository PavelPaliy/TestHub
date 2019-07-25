@extends('layouts.app')

@section('title', $test->name )

@section('content')
    <p>Вы набрали {{ $sum }} баллов из {{ $test->maxScore }} за этот тест!</p>
    @if($sum >= $test->minScore)
        <p>Вы прошли тест.</p>
    @else
        <p>Вы не прошли тест.</p>
    @endif
@endsection