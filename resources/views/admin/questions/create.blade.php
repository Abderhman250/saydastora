@extends('layouts.app')

@section('content')

    <div class="container">
        {{-- action="/users/update/{{$user->id}}" method="POST" --}}
        <h1 style="color: white; overflow: hidden; text-align: center">Questions & Answers</h1>
        <form id="question-form">
            @csrf
            <div class="row align-items-center">
                <div class="step-one row">
                    <div class="row col-6">
                        <label for="">Title:
                            <input type="text" name="title" id="title" class="form-control" required>
                        </label>
                    </div>
                    <div class="row col-6">
                        <label for="">Answer one:
                            <input type="text" name="answer1" id="answer1" class="form-control" required></label>
                    </div>
                    <div class="row col-6">
                        <label for="">Answer two:
                            <input type="text" name="answer2" id="answer2" class="form-control" required></label>
                    </div>
                    <div class="row col-6">
                        <label for="">Answer three:
                            <input type="text" name="answer3" id="answer3" class="form-control" required></label>
                    </div>
                    <div class="row col-6">
                        <label for="">Status:
                            <select name="status" id="status" class="form-control" required>
                                <option value="0">Not Active</option>
                                <option value="1" selected> Active</option>
                            </select>
                    </div>
                </div>






                <!-- Modal -->
                <div class="popup-overlay">
                    <!--Creates the popup content-->
                    <div class="popup-content">
                        <h2>Select Correct Answer</h2>
                        <h3 id="question"></h3>
                        <select name="answers" id="answers" onchange="getval(this);" class="form-control">
                            <option value="" selected></option>
                        </select>
                        <!--popup's close button-->
                        <button class="close ">Close</button>
                    </div>
                </div>
                <!--Content shown when popup is not displayed-->





                <div class="row col-12">
                    <button id="addQuestion" class="btn btn-primary open">Save</button>
                </div>
        </form>
    </div>

@endsection


