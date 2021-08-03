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
        $questions = Questions::all();
        if($questions){
            $data = [] ;
            foreach ($questions as $question) {
                $data [] = [
                    'question_id'=>$question->id,
                    'question_title'=>$question->question,
                    'question_correct_answer'=>$question->correct_answer,
                    'question_status'=>$question->status ? 'Active' : 'Not Active',
                ];
            }
        }
            return view('admin.questions.index',['questions'=>$data]);

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
    public function edit($id)
    {
        $question = Questions::findOrFail($id);
        if($question){
       return view('admin.questions.edit',['question'=>$question]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $question = Questions::findOrFail($id);
       if($question){
           $question->question = $request->title;
           $question->status = $request->status;
           $question->correct_answer_id = $request->correct_answer;

           $question->save();

             return redirect('/questions/edit/'.$id)->with('success','Question updated Successfully.');


       }
    }

    public function updateAnswer(Request $request, $id)
    {
        $answer = Answers::findOrFail($id);

        if($answer){
            $answer->answer = $request->answer;
            $answer->save();
            return redirect('/questions/edit/'.$answer->question->id)->with('success','Answer updated Successfully.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Questions::findOrFail($id);
        if($question){
            $question->delete();
            return redirect('/questions')->with('error','Question delete Successfully.');
        }

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
