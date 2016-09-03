@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')
	{!! HTML::style('css/parsley.css') !!}
	{!! HTML::style('css/select2.min.css') !!}
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
					{{ Form::label('slug', 'Slug:') }}
					{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}
				</div>


				<div class="form-group">
					{{ Form::label('category', 'Category:') }}
					<select class="form-control" name="category_id">
						@foreach($categories as $category)
							<option value='{{$category->id}}'>{{$category->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					{{ Form::label('tags', 'Tags:') }}
					<select class="form-control select2-multi" name="tags[]" multiple="multiple">
						@foreach($tags as $tag)
							<option value='{{ $tag->id }}'>{{ $tag->name }}</option>
						@endforeach
					</select>
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
	{!! HTML::script('js/parsley.js') !!}
	{!! HTML::script('js/select2.min.js') !!}



	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>
	
@endsection