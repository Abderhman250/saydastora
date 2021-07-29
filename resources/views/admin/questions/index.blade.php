@extends('layouts.app')

@section('content')
@extends('layouts.sidebar')

<div class="container">
        <div class="row">
            <div class="flash-message">

                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
            </div>
            <div><a  href="/questions/create" class="btn btn-primary" style="float: right; margin: 4px">Add Question</a></div>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Question</th>
                    <th scope="col">Status</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col">Options</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($questions) > 0)
                    @php
                        $i = 0;
                    @endphp
                        @foreach ($questions as $question)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$question['question_title']}}</td>
                            <td>{{$question['question_status']}}</td>
                            <td>{{$question['question_correct_answer']}}</td>

                            <td>

                                <a href="questions/edit/{{$question['question_id']}}" class="btn btn-primary">Edit</a>
                                <a href="questions/delete/{{$question['question_id']}}" class="btn btn-danger">Delete</a>

                            </td>

                        </tr>
                        @endforeach

                    @endif


                </tbody>
              </table>
        </div>

</div>

@endsection
