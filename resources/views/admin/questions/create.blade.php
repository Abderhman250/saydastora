@extends('layouts.app')
<style>
    .popup-overlay {
        /*Hides pop-up when there is no "active" class*/
        visibility: hidden;
        position: absolute;
        background: #ffffff;
        border: 3px solid #666666;
        width: 50%;
        height: 50%;
        left: 25%;
    }

    .popup-overlay.active {
        /*displays pop-up when "active" class is present*/
        visibility: visible;
        text-align: center;
    }

    .popup-content {
        /*Hides pop-up content when there is no "active" class */
        visibility: hidden;
    }

    .popup-content.active {
        /*Shows pop-up content when "active" class is present */
        visibility: visible;
    }

</style>
@section('content')
    <div class="container">
        @extends('layouts.sidebar')
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
        // -------multilevel-accordian-menu---------
        $(document).ready(function() {
            $("#accordian a").click(function() {
                var link = $(this);
                var closest_ul = link.closest("ul");
                var parallel_active_links = closest_ul.find(".active")
                var closest_li = link.closest("li");
                var link_status = closest_li.hasClass("active");
                var count = 0;

                closest_ul.find("ul").slideUp(function() {
                    if (++count == closest_ul.find("ul").length) {
                        parallel_active_links.removeClass("active");
                        parallel_active_links.children("ul").removeClass("show-dropdown");
                        link.not().children("ul").removeClass(".active");
                    }
                });

                if (!link_status) {
                    closest_li.children("ul").slideDown().addClass("show-dropdown");
                    closest_li.addClass("active");
                }

            })


        });






        // --------for-active-class-on-other-page-----------
        jQuery(document).ready(function($) {
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();

            // Account for home page with empty path
            if (path == '') {
                path = 'index.html';
            }

            var target = $('#accordian li a[href="' + path + '"]');
            // Add active class to target link
            target.parents("li").addClass('active');
            target.parents("ul").addClass("show-dropdown");
        });

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
