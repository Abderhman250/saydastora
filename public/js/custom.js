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

    $('#show-hidden-menu').click(function() {
        $('.attributes').slideToggle("slow");
        // Alternative animation for example
        // slideToggle("fast");
      });

