<?php

namespace App\Http\Controllers;

use  App\Quiz;
use  App\Question;
use  App\Choice;

use Session;
use Carbon;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		session_start(); 
    }
	
	
	/**
	 *
     * Show the Quiz Create form.
     *
     */
    public function createQuestion($quiz_id = null)
    {
		// remove all session variables
		session_unset(); 
		session_destroy(); 
		
		$_SESSION['question_no']  = Question::where(['quiz_id'=>$quiz_id])->max('id')+1;

		$data['quiz_id'] = $quiz_id; 
        return view('question/create',$data);
    }
	
	
	/**
	 *
     * Add Question the in Quiz form.
     *
     */
    public function addQuestion(Request $request )
    {
		  $request = $request->all(); 
		 
		  if(isset($_SESSION['question_no'])	)
		  {
				 $question_no = $_SESSION['question_no']+1;
				$_SESSION['question_no'] = $question_no; 
				
			
		  }
		  else 
		  {
			
			  $question_no = Question::where(['quiz_id'=>$request['quiz_id'] ])->max('id')+1; 
			  $_SESSION['question_no']  =  $question_no; 
			  
			
		  }
		
		if(isset($_SESSION['questions']))
		{
			
			$questions  = $_SESSION['questions']; 
			 array_push($questions,$question_no);
			 $_SESSION['questions']=$questions; 
		 
		}
		else 
		{
			$questions = [$question_no]; 
			$_SESSION['questions']=$questions; 
		}
		
	
		$data['question_no'] = $question_no;
		$data['success'] = 1; 
		$data['html']	= view('question/add_question',$data)->__toString();
        return $data; 
    }
	
	/**
	 *
     * Change Question Type and create relevent question html
     *
     */
    public function changeQuestionType(Request $request)
    {
		
		$request = $request->all();
		
		
		if(isset($request['type']))
		{
			if($request['type']==1)
			{
				$data['success'] = 1; 
				$data['type'] = $request['type'];
				$data['question_no']= $request['question_no'];
				$data['html']	= view('question/add_text_question',$data)->__toString();
				return $data; 
			}
			if($request['type']==2  || $request['type']==3)
			{
				$data['success'] = 1; 
				$data['type'] = $request['type'];
				$data['question_no']= $request['question_no'];
				$data['html']	= view('question/add_multiple_single_question',$data)->__toString();
				return $data; 
			}
			if( $request['type']==3)
			{
				$data['success'] = 1; 
				$data['type'] = $request['type'];
				$data['question_no']= $request['question_no'];
				$data['html']	= view('question/add_multiple_multi_question',$data)->__toString();
				return $data; 
			}
		}
    }
	
	/**
	 *
     * Add Choices the in Quiz Question.
     *
     */
    public function addChoice(Request $request)
    {
		
		$request = $request->all();
		
		if(isset( $_SESSION['choice'][$request['question_no']] ))
		{
			$choice_number = $_SESSION['choice'][$request['question_no']] + 1  ;
		    $_SESSION['choice'][$request['question_no']] = $choice_number ; 
			
		}
		else 
		{
			 $_SESSION['choice'][$request['question_no']]  = 1;
			 $choice_number = 1; 
		}
	
		if(isset($request['type']))
		{
			
			if($request['type']==2  )
			{
				$data['success'] = 1; 
				$data['choice_number'] =  $choice_number; 
				$data['question_no']= $request['question_no'];
				$data['html']	= view('question/add_single_choice',$data)->__toString();
				return $data; 
			}
			if( $request['type']==3)
			{
				$data['success'] = 1; 
				$data['choice_number'] =  $choice_number; 
				$data['question_no']= $request['question_no'];
				$data['html']	= view('question/add_multi_choice',$data)->__toString();
				return $data; 
			}
		}
    }
	
	/**
	 *
     * Delete Question Choice.
     *
     */
    public function deleteChoice(Request $request)
    {
		
		$request = $request->all();
		
		if(isset( $_SESSION['choice'][$request['question_no']] ))
		{
			if($_SESSION['choice'][$request['question_no']] == $request['choice_number'])
			{
				
				$choice_number = $_SESSION['choice'][$request['question_no']]-1  ;
				$_SESSION['choice'][$request['question_no']] = $choice_number ; 
			}
			if($request['choice_number'] ==1)
			{
				
				$choice_number =0 ;
				$_SESSION['choice'][$request['question_no']] = $choice_number ; 
			}
			
			
		}
		
	
	}
	
	/**
	 *
     * Delete Question .
     *
     */
    public function deleteQuestion(Request $request)
    {
		
		$request = $request->all();
		
		$questions = $_SESSION['questions']; 
		if (($key = array_search($request['question_no'], $questions)) !== false) {
			unset($questions[$key]);
		}

	    $_SESSION['questions'] = $questions; 
		print_r($questions); 
	}
	
	
	
	/**
	 *
     * Save Question.
     *
     */
    public function questionSave(Request $request)
    {
	
		$request = $request->all();
		
		
		foreach ( $_SESSION['questions'] as $question_no)
		{
			if(isset($request['question_type'.$question_no]))
			{
				if(isset($request['question_type'.$question_no]))
				{
					if($request['question_type'.$question_no]==1)
					{
						$question 				 =  new Question;
						$question->quiz_id 		 =  $request['quiz_id']; 
						$question->question_type =  $request['question_type'.$question_no]; 
						$question->question 	 =  $request['question'.$question_no]; 
						$question->answer 		 =  $request['answer'.$question_no]; 
						$question->created_at 		 =  Carbon::now();
						$question->save();
					}
					if($request['question_type'.$question_no]==2)
					{
						$question 				 =  new Question;
						$question->quiz_id 		 =  $request['quiz_id']; 
						$question->question_type =  $request['question_type'.$question_no]; 
						$question->question 	 =  $request['question'.$question_no]; 
						$question->created_at 		 =  Carbon::now();
						$question->save();
						$count_choice=1; 
						foreach ( $request['choice'.$question_no] as $c)
						{
							$correct = $request['choice'.$question_no][($request['radio'.$question_no]-1)]; 
							if($correct ==   $c )
								$correct = 1; 
							else 
								$correct = 0; 
							
							
							$data[] = [
										'question_id'	=>	$question_no 	 , 
										'choice_id'		=>	$count_choice	 , 
										'choice'		=>	$c 				 , 
										'correct'		=> 	$correct 		 , 
										'created_at'	=> 	Carbon::now()
									  ]; 
							$count_choice++;
						}
						Choice::insert($data);
					}
					
					if($request['question_type'.$question_no]==3)
					{
						$question 				 =  new Question;
						$question->quiz_id 		 =  $request['quiz_id']; 
						$question->question_type =  $request['question_type'.$question_no]; 
						$question->question 	 =  $request['question'.$question_no]; 
						$question->created_at 		 =  Carbon::now();
						$question->save();
						$count_choice=1; 
						
						foreach ( $request['choice'.$question_no] as $c)
						{
							
							
							if(isset($request['checkbox'.$question_no][$count_choice-1]))
							{
								$correct = $request['choice'.$question_no][(($request['checkbox'.$question_no][$count_choice-1])-1)]; 
								if($correct ==   $c )
									$correct = 1; 
								else 
									$correct = 0; 
							}
							else 
								$correct = 0;
							
							$data[] = [
										'question_id'	=>	$question_no 	 , 
										'choice_id'		=>	$count_choice	 , 
										'choice'		=>	$c 				 , 
										'correct'		=> 	$correct 		 , 
										'created_at'	=> 	Carbon::now()
									  ]; 
							$count_choice++;
						}
						Choice::insert($data);
					}
					
					
				}
			}
		}
		
		 return redirect()->back()->with('success',"Question No.  <b> $question_no</b> succesfully Saved!");
		
	}
		
}
