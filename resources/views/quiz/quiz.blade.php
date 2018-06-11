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
				
                <div class="panel-heading"><h2>Create Quiz</h2></div>
				
                <div class="panel-body">
						<table class="table table-striped table-bordered table-condensed">
								 <thead>
									<tr>
										<th>Id</th>
										<th>name</th>
										<th>Number of Questions</th>
										<th>duration</th>
										<th>Resumable</th>
										<th>Published</th>
										<th>Action</th>
										
									</tr>
								  </thead>
								  <tbody>
									
									  @foreach($quiz as $row)
										<tr>
											<th>{{ $row['id'] }}</th>
											<th>{{ $row['name'] }}</th>
											<th>{{$row['question_count']}}-<a href="{{url('/question/create/'.$row['id'])}}" >Add</a></th>
											<th>{{ $row['duration'].' '.$row['duration_type'] }}</th>
											<th>{{ $radio[$row['resumable']] }}</th>
											<th>{{ $radio[$row['published']] }}</th>
											<th><a href="{{url('questionaire/delete/'.$row['id'])}}" >Delete</a></th>
										</tr>
									   @endforeach
									
								  </tbody>
						</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
