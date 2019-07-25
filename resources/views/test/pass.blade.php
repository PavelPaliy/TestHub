@extends('layouts.app')

@section('title', $test->name )

@section('content')
    <div class="row">
        <div class = 'col-md-8 right'>
            <form id="test" method="POST" action="/test/{{ $test->id }}/question">
                {{csrf_field()}}
                <div class="row">
                    <div class = 'col-md-8 right'>
                    <div class ='form-group'><label>{{ $question_number+1 }}){{ $test->questions[$question_number]->title }}</label></div>
                    @if($test->questions[$question_number]->type==1)
                        @foreach($answers as $answer)
                            @if($answer==$info)
                                <div class ='form-group'><input type='radio'  class='form-check-input' value = '{{ $answer }}' name='answer' checked> <label>{!! $answer !!}</label></div>
                            @else
                                    <div class ='form-group'><input type='radio'  class='form-check-input' value = '{{ $answer }}' name='answer'> <label>{!! $answer !!}</label></div>
                             @endif
                        @endforeach
                    @elseif($test->questions[$question_number]->type==2)
                        <input type="hidden" value="{{ $i=0 }}">
                        @foreach($answers as $answer)
                            @if(strripos($info, 'answer'.$i))
                                <div class ='form-group'><input type='checkbox'  class='form-check-input' value = '{{ $answer }}' name='answer{{ $i }}' checked> <label>{{ $answer }}</label></div>
                            @else
                                    <div class ='form-group'><input type='checkbox'  class='form-check-input' value = '{{ $answer }}' name='answer{{ $i }}' > <label>{{ $answer }}</label></div>
                            @endif
                            <input type="hidden" value="{{ $i++ }}">
                        @endforeach
                    @else
                        <div class ='form-group'><input type='text' name="answer" value="{{ $info }}"></div>
                    @endif
                    <input type="hidden" value="{{ $question_number }}" name = "question_number" >
                    @if((count($test->questions)-1)>$question_number)
                        <input type="submit" value="Следующий вопрос" name="result">
                    @else
                        <input type="submit" value="Завершить тест" name="result">
                    @endif
                    </div>
                    <div class = 'col-md-4'>
                    @for($i=0; $i<count($test->questions); $i++)
                        @if($i==$question_number)
                            <input type="button" value="{{ $i+1 }}" class="current qlink" name = "current qlink">
                        @else
                            <input type="submit" value="{{ $i+1 }}" class="not_current qlink" name="not_current qlink">
                        @endif
                    @endfor
                    </div>
                </div>

            </form>
        </div> <div class = 'col-md-4'>

        </div></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@endsection