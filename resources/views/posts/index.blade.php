@extends('main')

@section('title', '| All Posts')

@section('content')

	<div class="row">
		<div class="col-md-10">
				<h1>All Posts</h1>
		</div>

		<div class="col-md-2">
			<a href="{{ route('posts.create') }}" class="btn btn-block btn-primary btn-h1-spacing">Create New Post</a>
		</div>
		<hr>
	</div> <!--end of row -->

	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th>Created At</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						<td>{{substr($post->body, 0, 50) }}{{ strlen($post->body)>50 ? "…" : "" }}</td>
						<td>{{ date('M j, Y', strtotime($post->created_at)) }}</td>
						<td style="text-align:center"><a href="{{ route('posts.show', $post->id)}}" class="btn btn-default btn-sm">View</a> 
					@if(Auth::user()->id == $post->user->id)
						<a href="{{ route('posts.edit', $post->id)}}" class="btn btn-default btn-sm">Edit</a>
					@endif
					</tr>
					@endforeach
				</tbody>

			</table>


			<div class="text-center">
				
				{!! $posts->links(); !!}
			</div>




		</div>
	</div>


@stop