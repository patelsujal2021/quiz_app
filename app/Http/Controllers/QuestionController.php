<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::paginate(100);
        return view('admin.questions.index',compact('questions'));
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->time_limit = $request->time_limit;
            $question->correct_answer = 0;
            if($question->save()){
                foreach($request->answers as $answerKey => $answerValue){
                    $answer = Answer::create(['title'=>$answerValue,'question_id'=>$question->id]);
                    if($answerKey == $request->correct_answer) {
                        Question::where('id',$question->id)->update(['correct_answer'=>$answer->id]);
                    }
                }

                $notification = ['message'=>"Question details stored successfully",'type'=>'success'];
                return redirect()->route('question.index')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = ['message'=>"Something wrong!",'type'=>'warning'];
            return redirect()->route('question.index')->with($notification);
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $question = Question::with('answers')->find($id);
        return view('admin.questions.edit',compact('question'));
    }

    public function update(Request $request, $id)
    {
        try {
            foreach($request->answers as $answerId => $answerValue){
                Answer::where(['id'=>$answerId,'question_id'=>$id])->update(['title'=>$answerValue]);
            }

            $question = Question::find($id);
            $question->title = $request->title;
            $question->correct_answer = $request->correct_answer;
            $question->time_limit = $request->time_limit;
            if($question->save()){
                $notification = ['message'=>"Question details updated successfully",'type'=>'success'];
                return redirect()->route('question.index')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = ['message'=>"Something wrong!",'type'=>'warning'];
            return redirect()->route('question.index')->with($notification);
        }
    }

    public function destroy($id)
    {
        try {
            $question = Question::find($id);
            Answer::where('question_id',$id)->delete();
            if ($question->delete()) {
                $notification = ['toastr' => "Question delete successfully", 'type' => 'success'];
                return redirect()->route('question.index')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = ['message'=>"Something wrong!",'type'=>'warning'];
            return redirect()->route('question.index')->with($notification);
        }
    }
}
