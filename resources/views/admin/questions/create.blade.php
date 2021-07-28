@extends('layouts.app')

@section('content')
@extends('layouts.sidebar')

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
    <script>
        jQuery(document).ready(function($) {
            $("#addQuestion").click(function() {
                $("#question-form").submit(function(e) {
                    e.preventDefault();
                });

                let question = $('#title').val()
                let answer1 = $('#answer1').val()
                let answer2 = $('#answer2').val()
                let answer3 = $('#answer3').val()
                let status = $('#status').val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/questions/store',
                    type: 'post',
                    data: {
                        question: question,

                        answers: {
                            answer1: answer1,
                            answer2: answer2,
                            answer3: answer3,
                        },
                        status: status,
                    },
                    success: function(data) {
                        $('#question').text(data[0].question)

                        data[0].answers.forEach(element => {
                            console.log('eleId:', element.answer_id, 'name:', element
                                .answer);
                            var opt = $("<option>").val(element.answer_id).text(element
                                .answer);
                            $('#answers').append(opt);

                        });
                        $('#answers').attr('question-id',data[0].question_id)




                        $(".popup-overlay, .popup-content").addClass("active");

                        //removes the "active" class to .popup and .popup-content when the "Close" button is clicked
                        $(".close, .popup-overlay").on("click", function() {
                            $(".popup-overlay, .popup-content").removeClass("active");
                        });
                    },
                    error: function(data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
                });
            })
        });

        function getval(sel) {
            // alert(sel.value);
            let correctAnswer = sel.value;
                $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '/questions/correct_answer',
                            type: 'post',
                            data: {
                                question_id: $('#answers').attr('question-id'),
                                correct_answer_id:correctAnswer ,
                            },
                            success: function(data) {
                                console.log('success', data);

                    },
                    error: function(data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
            });
        }

    </script>
@endsection

