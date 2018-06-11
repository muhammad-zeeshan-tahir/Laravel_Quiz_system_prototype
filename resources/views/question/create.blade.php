@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
			
				
				@if( $message = session('success') )
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fa fa-check"></i>
						{!! $message !!}
					</div>
				@endif

				@if( $message = session('error') )
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="icon fa fa-ban"></i> {!! $message !!}
					</div>
				@endif
				
                <div class="panel-heading"><h2>Create Question</h2></div>
				
                <div class="panel-body">
							
					<form class="form-horizontal" method="get" action="{{route('questionSave')}}">
				
					
							<div id="form">
								
									
							</div>
							<div class="form-group">
								<div class="col-md-4"><a class="navbar-brand" style="cursor: pointer;" id="addQuestion" >Add New Question</a></div>
								<div class="col-md-8"></div>
							</div>
							
							
							<br /><br /><br /><br />
							<div class="form-group">
								<div class="col-md-2">
										<input type="submit" class="navbar-brand" style="cursor: pointer;" value="save" >
								</div>
								<div class="col-md-10">
									
								</div>
							</div>
							<input type="hidden" name="quiz_id" value="{{$quiz_id}}" />
					<form>
							
							
						

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
			<script>
						$(document).ready(function()
						{
							
							 $("#addQuestion").on("click", function (e)
							 {
									$.ajax ({
												url: '{{route('addQuestion')}}',
												data:{
														quiz_id : {{$quiz_id}}	
												},
												type: 'get',
												dataType: 'json',
												success: function(data)
												{
													if(	data['success'] == 1 )
													{
														
														$("#form").append(data['html']);
														t(data['question_no']); 
														delete_question(data['question_no']);
													}
													

												}
										});
							 }); 
							 
							 
							 
							 
							 
							 
							 function t(question_no)
							 {
								 $('#question_type'+question_no).on("change", function (e)
								 {
									
									// id = 	$('#question_type'+id).data("id");
									
									 $.ajax ({
													url: '{{route('changeQuestionType')}}',
													data:{
															type : $('#question_type'+question_no).find(":selected").val(),
															question_no : question_no
													},
													type: 'get',
													dataType: 'json',
													success: function(data)
													{
														if(	data['success'] == 1 )
														{
														
															$("#question_detail"+question_no).empty().append(data['html']);
															t1(question_no);
															
														}
															
														

													}
											});
								});
							 }
							
							 
							 function t1(question_no)
							 {
								 
								
								 $('#addchoice'+question_no).on("click", function (e)
								 {
									// alert('#addchoice'+question_no);
									
									// id = 	$('#question_type'+id).data("id");
									
									 $.ajax ({
													url: '{{route('addChoice')}}',
													data:{
															type : $('#addchoice'+question_no).data("type"),
															question_no : question_no
													},
													type: 'get',
													dataType: 'json',
													success: function(data)
													{
														if(	data['success'] == 1 )
														{
														
															$("#questionchoice"+question_no).append(data['html']);
															delete_question_choice(data['question_no'],data['choice_number'])
														}
														

													}
											});
								});
							 }
							 function delete_question(question_no)
							 {
								 
								 $('#deletequestion'+question_no).on("click", function (e)
								 {
									
										$(".question"+question_no).remove();
										$.ajax ({
													url: '{{route('deleteQuestion')}}',
													data:{
															question_no : question_no,
													},
													type: 'get',
													dataType: 'json',
													success: function(data)
													{
														
													}
											});
								});
							 }
							 function delete_question_choice(question_no,choice_number)
							 {
								 
								 $('#deletechoice'+question_no+choice_number).on("click", function (e)
								 {
									 $("#questionchoice"+question_no+choice_number).remove();
											$.ajax ({
													url: '{{route('deleteChoice')}}',
													data:{
															question_no : question_no,
															choice_number : choice_number
													},
													type: 'get',
													dataType: 'json',
													success: function(data)
													{
														
													}
											});
										
										
								 });
							 }
							 
						}); 
						
						
						

			</script>
@endsection