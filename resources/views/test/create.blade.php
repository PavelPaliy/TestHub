@extends('layouts.app')

@section('title', 'Создать тест')

@section('content')
    <link rel="stylesheet" href="{{ URL::asset('css/create.css') }}" type="text/css">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1><small>Создание теста</small></h1>
    <p>Пожалуйста, заполните описание теста и добавьте необходимое число вопросов с помощью формы ниже. После этого тест будет создан и вы получите ссылку на него.</p>

    <form action="{{ action('TestController@store') }}" method="POST"  class="formForNewT" name ="formForNewTest">
        {{csrf_field()}}
        <div class="mainInfoNewTest">
            <div class = "form-group">
                <label>Название теста</label><input type ="text" class="text form-control" name="title">
            </div>
            <div class = "form-group">
                <label>Теги</label><input type ="text" class="text form-control" name="tags" id ="tags">
                <ul class="list-group" id = 'tag-list'>

                </ul>
            </div>
            <div class = "form-group">
                <label>Предисловие</label><textarea cols="128" rows="8"  name="intro" class = "form-control" ></textarea>
            </div>
            <div class = "form-row">
                <div class="col-md-6"><label>Ограничение по времени</label><input type ="text" class="form-control" name ="time" value="120"></div>
                <div class="col-md-6"><label>Проходной балл</label><input type ="text" class="form-control" name ="minScore" value="60"></div>
            </div>


        </div>
        <hr>
        <h1>Вопросы</h1>
        <div class="questions">

            <div class="q" id ="q1">
                <hr>
                <h4>1 вопрос</h4>
                <div class = "form-group">
                    <label>Название</label><input type="text" name="title1" class="text form-control">
                </div>
                <div class = "form-group">
                    <label>Количество баллов за правильный ответ</label><input type="text" name="score1" class="text form-control">
                </div>
                <div class = "form-group">
                    <label>Тип вопроса</label>
                    <select class="selectTypeQ form-control" id ="typeQ1" name="typeQ1">
                        <option value="1">Один ответ из списка</option>
                        <option value="2">Несколько вариантов из списка</option>
                        <option value="3">Ввод текста</option>
                    </select>
                </div>
                <button class ="selectTypeB btn btn-primary" id="1">Выбрать тип</button>
                <hr>

            </div>
            <div class="form-row">
                <button class="addQ btn btn-primary">Добавить вопрос</button>
            </div>
        </div>



        <!--<input type ="submit" value="Создать тест">-->

        <button class="btn btn-success" type="submit">Создать тест</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src ="{{ URL::asset('js/selectType.js') }}"></script>
    <script src ="{{ URL::asset('js/addQ.js') }}"></script>
    <script src ="{{ URL::asset('js/tags.js') }}"></script>
    <script src ="{{ URL::asset('js/valid.js') }}"></script>
    <script src ="{{ URL::asset('js/changeType.js') }}"></script>
    <script src ="{{ URL::asset('js/deleteA.js') }}"></script>
    <script src ="{{ URL::asset('js/deleteQ.js') }}"></script>

@endsection