







		<div class="form-group" id="questionchoice{{ $question_no.$choice_number }}">
			<label for="choice" class="col-md-4 control-label"> Choice {{ $choice_number }} </label>
			 <div class="col-md-4">
					
					<input  type="text" class="form-control" id="choice{{$question_no.$choice_number}}" name="choice{{$question_no}}[]" required autofocus >

			 </div>
			  <div class="col-md-1">
					
						<input type="checkbox" class="form-control" name="checkbox{{$question_no}}[]" id="checkbox{{$question_no.$choice_number}}" value="{{$choice_number}}"> 
						
			  </div>
			  <div class="col-md-1">
					<label class="radio">
						Correct ? 
					 </label>
			  </div>
			 <div class="col-md-2">
					
						<a id="deletechoice{{$question_no}}" class="navbar-brand" style="cursor: pointer;"  data-id="{{ $question_no.$choice_number }}"  >Delete</a>
			 </div>
		</div>
		