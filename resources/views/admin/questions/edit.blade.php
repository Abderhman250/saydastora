@extends('layouts.app')
@section('content')


    <div class="container">
        {{-- action="/users/update/{{$user->id}}" method="POST" --}}
        <h1 style="color: white; overflow: hidden; text-align: center">Edit Question</h1>


        <div class="edit-questions">
            <form id="question-form" method="POST" action="/questions/update/{{$question->id}}" >
                @csrf
                <div class="step-one row">
                    <div class="col-12">
                        <label for="">Title:
                            <input type="text" name="title" id="title" value="{{ $question->question }}" class="form-control"
                                required>
                        </label>
                    </div>

                    <div class="col-12">
                        <label for="">Status:
                            <select name="status" id="status" class="form-control" required>
                                <option value="0">Not Active</option>
                                <option value="1" selected> Active</option>
                            </select>
                    </div>
                    <div class="col-12">
                        <label for="">Correct answer:
                            <select name="correct_answer" id="status" class="form-control" required>
                                @foreach ($question->answers as $answer)

                                    <option {{$question->correct_answer_id ==$answer->id ? 'selected' : ''}} value="{{$answer->id}}">{{$answer->answer}}</option>

                                @endforeach
                            </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg">Edit</button>
                    </div>


                </div>

            </form>
        </div>
        @php
            $i = 1;
        @endphp
        <div class="row answer">
            <h3>Edit Answers</h3>
            @foreach ($question->answers as $answer)
                <form action="/answer/update-answer/{{ $answer->id }}" method="POST">
                @csrf

                    <label for="">Answer-{{ $i++ }}:
                        <input type="text" name="answer" id="" value="{{ $answer->answer }}" class="form-control"
                            required></label>
                    <button class="btn btn-primary btn-sm">Edit</button>

                </form>

            @endforeach
        </div>
    </div>
@endsection
