<?php

namespace App\Http\Controllers;
use App\Answer;
use App\Question;
use App\Subject;
use Illuminate\Http\Request;
use View;
use App\User;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth')->only(['store','create','destroy']);
    }

    public function index($subjectslug = null,Question $question) /* 2nd  (Subject $subject)*/
    {   /*1st  QUESTION BELONGS TO SUBJECT WAY*/
       if($subjectslug) {
        $subjectid = Subject::where('subslug',$subjectslug)->first()->id;
        $questions = Question::where('subject_id',$subjectid)->latest()->get();
       } else {
        $questions =  Question::latest()->get();
       } 

       if($username = request('by')){
        $user = \App\User::where('name',$username)->firstOrFail();
        $questions = $questions->where('user_id',$user->id);
       }

      
      if($mostanswered = request('mostanswered')){

        $questions = $questions->sortByDesc('answers_count');
       }

        if(request()->wantsJson()){
        return $questions;
       }



       return view('questions.index',compact('questions'));
 /*2nd
 SUBJECT HAS MANY QUESTIONS WAY (TDD DIDN'T PASS-!!!!!)       

     if($subject->exists){
            $questions = $subject->questions()->latest()->get();

        }else{
            $questions = Question::latest()->get();
        }

         return view('questions.index',compact('questions'));
    */

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $this->validate($request,[
          'qtitle' => 'required',
          'qdetails'=> 'required',
          'subject_id' => 'required|exists:subjects,id'
        ]); 
       $question = Question::create([
            'user_id'=>auth()->id(),
            'qtitle'=>request('qtitle'),
            'qdetails'=>request('qdetails'),
            'qnop'=>request('qnop'),
            'subject_id'=>request('subject_id')  
        ]);
       return redirect($question->path())
       ->with('flash','Question created!');
    }

    /**
     * Display the specified resource.
     * @param \App\Subject $subjectid
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($subjectid, Question $question, Answer $answer) //$subjectId as we wish to make our url of type /questions/channel/question->id. But I fond that even if I wrote $AddAnythingHeretoPreventErrorJefreyWroteSubjectId still works. Means anything with $___ is accepted to make it work. Don't know why? Find out!!!!!!!!!!!
    {   return view('questions.show', compact('question','answer'));
    }


      


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
  public function destroy($subjectid, Question $question) 
    {  

        $this->authorize('update',$question);
   // Above lime does the same with Policesif($question->user_id!=auth()->id()){
   //  abort(403,'You do not have permission');
   // }

     // Doing related answer deletion from model now  $question->answers()->delete();
        $question->delete();
        if(request()->wantsJson()){
            return response([],204);
        }
        return redirect('/questions');
    }
}
