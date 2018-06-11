



		<div class="form-group{{ $errors->has('question_type') ? ' has-error' : '' }}">
			<label for="question_type" class="col-md-4 control-label"> Question</label>
			 <div class="col-md-4">
					
					<input  type="text" class="form-control" name="question{{$question_no}}" required autofocus >

			 </div>
			
		</div>
		<div id="questionchoice{{$question_no}}">
			 
		</div>
		<div class="form-group">
			 <div class="col-md-4"></div>
			 <div class="col-md-8">
				<a id="addchoice{{$question_no}}" class="navbar-brand" style="cursor: pointer;" data-type="{{$type}}" data-id="{{$question_no}}"  >Add New choice</a>
			</div>
		</div>