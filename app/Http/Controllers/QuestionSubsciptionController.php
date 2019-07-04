<?php

namespace App\Http\Controllers;
use App\Question;
use App\QuestionSubsciption;
use Illuminate\Http\Request;

class QuestionSubsciptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subjectId, Question $question){
      $question->subscribe();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionSubsciption  $questionSubsciption
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionSubsciption  $questionSubsciption
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionSubsciption $questionSubsciption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionSubsciption  $questionSubsciption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionSubsciption $questionSubsciption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionSubsciption  $questionSubsciption
     * @return \Illuminate\Http\Response
     */
    public function destroy($subjectId,Question $question)
    {
         $question->unsubscribe();
    }
}
