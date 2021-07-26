<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Questions;
use Illuminate\Http\Request;
use Validator;
use Symfony\Component\Console\Question\Question;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $successStatus = 200;

    public function index()
    {
        dd(Questions::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question' => ['required', 'string'],
            'answers' => ['required'],
            // 'answer2' => ['required', 'string', 'max:255'],
            // 'answer3' => ['required', 'string', 'max:255'],

        ]);
        if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
                }
        $question = new Questions();

        $question->question = $request->question;
        $question->status = $request->status;
        $question->save();

        foreach($request->answers as $ans){
            $answer = new Answers();
            $answer->question_id = $question->id;
            $answer->answer = $ans;

            $answer->save();
        }
        // dd($question->answers);
        $data['question_id'] = $question->id;
        $data['question'] = $question->question;
        $all_answer = [];
        foreach ($question->answers as $one) {
            $all_answer[] = [
                'answer_id'=>$one->id,
                'answer'=>$one->answer,
            ];
        }
        $data['answers'] = $all_answer;





        return response()->json([ $data], $this-> successStatus);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        //
    }

    public function setCorrectAnswer(Request $request)
    {
        $question = Questions::findOrFail($request->question_id);
        if($question){
            $question->correct_answer_id = $request->correct_answer_id ;
            $question->save();
        }

        return redirect('/questions')->with('success','Question add Successfully.');


    }
}
