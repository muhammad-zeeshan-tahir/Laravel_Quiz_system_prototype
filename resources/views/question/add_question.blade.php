




	<div class="question{{$question_no}}" >
		<div class="form-group{{ $errors->has('question_type') ? ' has-error' : '' }}">
			<label for="question_type" class="col-md-4 control-label"> Question Type</label>
			 <div class="col-md-4">
					<select class="form-control question_type" id="question_type{{$question_no}}" data-id="{{$question_no}}" name="question_type{{$question_no}}">
						<option >select Question</option>
						<option value="1">Text</option>
						<option value="2">Multiple choice ( Single Option ) </option>
						<option value="3">Multiple choice ( Multi Option ) </option>
					</select>
			 </div>
			 <div class="col-md-4">
				<a id="deletequestion{{$question_no}}" class="navbar-brand" style="cursor: pointer;"  data-id="{{$question_no}}"  >Delete</a>
			</div>
		</div>
		<div id="question_detail{{$question_no}}">
		</div>
	</div>
	
	