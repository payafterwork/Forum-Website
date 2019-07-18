<?php
namespace App\Http\Controllers;
use App\Answer;
use App\Question;
use App\User;
use Illuminate\Auth\Middleware\Auth;
use Illuminate\Http\Request;
use App\Notifications\YouWereMentioned;
use Illuminate\Support\Facades\Notification;
class AnswerController extends Controller
{
    function __construct()
    {
      $this->middleware('auth')->only(['store','destroy','update']);
    }

    public function index($channelId, Question $question){
        return $question->answers()->paginate(10);

    }
    public function store(Request $request,$subjectid, Question $question)
    {  
      $this->validate($request,[
        'ans' => 'required'
       ]);
      $answer= $question->addAnswer([
          'ans'=>request('ans'),
          'user_id'=>auth()->id()
      ]);
        preg_match_all('/\@([^\s\.]+)/', $answer->ans, $matches);
        $names = $matches[1];

      $users = User::whereIn('name', $names)->get();
        Notification::send($users, new YouWereMentioned($answer));
    
      if(request()->expectsJson()){
         return $answer->load('owner');
      }
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