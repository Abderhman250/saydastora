@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <h3 style="padding: 10px;">Questions and Answers</h3>

            <div style="width: 100%"><a  href="/questions/create" class="btn btn-primary" style="float: right; margin: 4px">Add Question</a></div>
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
