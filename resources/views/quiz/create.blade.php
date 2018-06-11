@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
				
                <div class="panel-heading"><h2>Create Quiz</h2></div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('createQuizSave') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Question Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                            <label for="duration" class="col-md-4 control-label">Duration ( Hours ) </label>

                            <div class="col-md-3">
                                <input id="duration" type="text" class="form-control" name="duration" value="{{ old('duration') }}" required>
								
                                @if ($errors->has('duration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('duration') }}</strong>
                                    </span>
                                @endif
                            </div>
							 <div class="col-md-3">
									<select class="form-control" name="duration_type" id="duration_type" >
										<option @if(old('duration_type')=='hours') {{'selected="selected"'}}  @endif value="hours">hours</option>
										<option @if(old('duration_type')=='minutes') {{'selected="selected"'}} @endif value="minutes">minutes</option>
									 </select>
									@if ($errors->has('duration_type'))
										<span class="help-block">
											<strong>{{ $errors->first('duration_type') }}</strong>
										</span>
									@endif
							 </div>
                        </div>

                        <div class="form-group{{ $errors->has('resumable') ? ' has-error' : '' }}">
                            <label for="resumable" class="col-md-4 control-label">Can resume</label>
							
                            <div class="col-md-3">
                                <input id="resumable" type="radio" name="resumable"  value="1" @if(old('resumable')=='1') {{'checked'}} @endif required > Yes
								<input id="resumable" type="radio"  name="resumable" value="0" @if(old('resumable')=='0') {{'checked'}} @endif  required > No

                                @if ($errors->has('resumable'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('resumable') }}</strong>
                                    </span>
                                @endif
                            </div>
							
                        </div>
						
						<div class="form-group{{ $errors->has('published') ? ' has-error' : '' }}">
                            <label for="published" class="col-md-4 control-label">Can publish</label>

                            <div class="col-md-6">
                                <input id="published" type="radio" name="published"  value="1" @if(old('published')=='1') {{'published'}} @endif > Yes
								<input id="published" type="radio"  name="published" value="0" @if(old('published')=='0') {{'published'}} @endif > No

                                @if ($errors->has('published'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('published') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
