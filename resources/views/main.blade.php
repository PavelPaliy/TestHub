@extends('layouts.app')

@section('title', 'Создать тест')

@section('content')
    <h1>TestHub</h1>
@endsection

@section('right')
    <h2>О сайте</h2>
    <p>TestHub - это сервис, который позволяет вам легко создавать свои тесты для проверки знаний и просматривать результаты в удобном интерфейсе. Для создания и прохождения теста не требуется регистрация, но мы советуем это сделать, так как в этом случае вы легко сможете управляь своими тестами.</p>
    <button type="button" class="btn btn-danger"><a class="button" href="{{ route('test.create') }}"> Создать тест</a></button>
    <button type="button" class="btn btn-link"><a href="{{ route('register') }}">Зарегистрироваться</a></button>
    <button type="button" class="btn btn-link"><a href="{{ route('login') }}">Войти</a></button>


@endsection