@extends('main')

@section('title', '|Create New Post')

@section('stylesheets')
	{!! HTML::style('css/parsely.css') !!}
@endsection


@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			{!! Form::open(['route' => 'posts.store', 'data-parsely-validate' => '']) !!}
				<div class="form-group">
					{!! Form::label('title', 'Title:')  !!}
					{!! Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])  !!}
				</div>

				<div class="form-group">
					{{ php Form::label('slug', 'Slug:') }}
					{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}
				</div>

				<div class="form-group">
					{!! Form::label('body', 'Body:')  !!}
					{!! Form::textarea('body', null, ['class' => 'form-control', 'required' => ''])  !!}
				</div>
			
				
			
				<div class="form-group">
					{!! Form::submit('Create Post', ['class' => 'btn btn-success btn-block form-control']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	
@endsection
		
@section('scripts')
	{!! HTML::script('js/parsely.js') !!}
@endsection