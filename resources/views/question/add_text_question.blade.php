







	
		<div class="form-group{{ $errors->has('question_type') ? ' has-error' : '' }}">
			<label for="question_type" class="col-md-4 control-label"> Question</label>
			 <div class="col-md-4">
					
					<input  type="text" class="form-control" name="question{{$question_no}}" required autofocus >

			 </div>
		</div>
		<div class="form-group{{ $errors->has('question_type') ? ' has-error' : '' }}">
			<label for="question_type" class="col-md-4 control-label"> Answer</label>
			 <div class="col-md-4">
					
					<input  type="text" class="form-control" name="answer{{$question_no}}" required autofocus >

			 </div>
		</div>
	