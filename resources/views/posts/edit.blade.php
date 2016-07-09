@extends('main')

@section('title', '| Edit Blog Post')

@section('content')


	{!! Form::model($post,[
		'method'=>'PATCH',
		'route' => ['posts.update', $post->id],
		'data-parsely-validate' => ''

	])!!}

	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				{!! Form::label('title', 'Title:')  !!}
				{!! Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])  !!}
			</div>


			<div class="form-group">
				{!! Form::label('body', 'Body:')  !!}
				{!! Form::textarea('body', null, ['class' => 'form-control', 'required' => ''])  !!}
			</div>
						
							
		</div>





			
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
					
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! HTML::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::submit('Save Changes', ['class' => 'btn btn-success btn-block form-control']) !!}
					</div>
				</div>

					
			</div>	
			
		</div>
	</div>	<!-- end of the form -->
{!! Form::close() !!}










@stop