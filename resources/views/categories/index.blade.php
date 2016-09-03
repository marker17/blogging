@extends('main')

@section('title', 'All Categories')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
				</thead>
				
				
				<tbody>
					@foreach ($categories as $category)
					<tr>
						<th>{{ $category->id }}</th>
						<td>{{ $category->name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well">
			{!! Form::open(['method' => 'POST', 'action'=>'CategoryController@store'])  !!}
				<h2>New Category</h2>
				<div class="form-group">
					{{ Form::label('name', 'Name:') }}
					{{ Form::text('name', null, ['class' => 'form-control']) }}
				</div>

				{{ Form::submit('Create new category', ['class' => 'btn btn-primary btn-block']) }}

				
			{!! Form::close() !!}
		</div>



		
	</div>
@endsection
