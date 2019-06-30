<?php
namespace App\Http\Controllers;
use App\Answer;
use App\Question;
use Illuminate\Auth\Middleware\Auth;
use Illuminate\Http\Request;
class AnswerController extends Controller
{
    function __construct()
    {
      $this->middleware('auth')->only(['store','destroy','update']);
    }
    public function store(Request $request,$subjectid, Question $question)
    {  
      $this->validate($request,[
        'ans' => 'required'
       ]);
      $question->addAnswer([
          'ans'=>request('ans'),
          'user_id'=>auth()->id()
      ]);
       return back()->with('flash','Answer posted!');;
    }

     /**
     * Delete the given reply.
     *
     * @param  Answer $answer
     * @return \Illuminate\Http\RedirectResponse
     */
  public function destroy(Answer $answer){
      
      $this->authorize('update',$answer);
        $answer->delete();
        if(request()->wantsJson()){
            return response(['status'=>'Answer Deleted']);
        }
        return back();
    }

    /**
     * Update an existing reply.
     *
     * @param Answer $answer
     */
    public function update(Answer $answer)
    {
        $this->authorize('update', $answer);
        $this->validate(request(), ['ans' => 'required']);
        $answer->update(request(['ans']));
    }
}