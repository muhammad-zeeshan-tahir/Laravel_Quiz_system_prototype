<?php

namespace App\Http\Controllers;

use  App\Quiz;
use Carbon;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
     * Show the Quiz  form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$quiz = Quiz::orderby('id','asc')->get();
		$tmp=[]; 
		foreach($quiz as $row)
		{
			$tmp[]= [
						'id'			    => $row['id'] 									,	
						'question_count'    => Quiz::find($row['id'])->question->count()	,
						'name'				=> $row['name']									,
						'duration'			=> $row['duration'] 							,
						'duration_type'		=> $row['duration_type'] 							,
						'resumable'			=> $row['resumable'] 							,
						'published'			=> $row['published']							
					]; 
		}	
		$data['quiz'] = $tmp; 
		$data['radio']=['No','Yes'];
        return view('quiz/quiz',$data);
    }
	
	
    /**
     * Show the Quiz Create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function createQuiz()
    {
        return view('quiz/create');
    }
	
	 /**
     * Delete the Quiz Create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteQuiz($id=null)
    {
		$quiz = Quiz::find($id); 
		$quiz->delete();
		
        return redirect()->back()->with('success',"Quiz No.  <b> $id</b> succesfully Delete!");
    }
	
	/**
     * Save the Quiz Create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function createQuizSave(Request $request)
    {
		$rules = [
					'name'  		=> 'required'	,
					'duration'  	=> 'required'	,
					'duration_type'	=> 'required'   ,
					'resumable' 	=> 'required'	,
					'published' 	=> 'required'
				 ];

		$validator = \Validator::make($request->all(), $rules);

		
		if($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator);
		}


		$quiz = new Quiz;

        $quiz->user_id = Auth::user()->id; 
		$quiz->name = $request->name;
		$quiz->duration = $request->duration;
		$quiz->duration_type = $request->duration_type;
		$quiz->resumable = $request->resumable;
		$quiz->published = $request->published;
		$quiz->created_at = Carbon::now();

        $quiz->save();

        return redirect()->back()->with('success','Quiz succesfully save!');
		
    }
	
}
