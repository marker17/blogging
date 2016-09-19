@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')
	{!! HTML::style('css/parsley.css') !!}
	{!! HTML::style('css/select2.min.css') !!}




	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
	  var editor_config = {
	    path_absolute : "/",
	    selector: "textarea",
	    plugins: [
	      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	      "searchreplace wordcount visualblocks visualchars code fullscreen",
	      "insertdatetime media nonbreaking save table contextmenu directionality",
	      "emoticons template paste textcolor colorpicker textpattern"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
	    relative_urls: false,
	    file_browser_callback : function(field_name, url, type, win) {
	      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
	      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

	      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
	      if (type == 'image') {
	        cmsURL = cmsURL + "&type=Images";
	      } else {
	        cmsURL = cmsURL + "&type=Files";
	      }

	      tinyMCE.activeEditor.windowManager.open({
	        file : cmsURL,
	        title : 'Filemanager',
	        width : x * 0.8,
	        height : y * 0.8,
	        resizable : "yes",
	        close_previous : "no"
	      });
	    }
	  };

	  tinymce.init(editor_config);
	</script>
	
@endsection


@section('content')


	{!! Form::model($post,[
		'method'=>'PATCH',
		'route' => ['posts.update', $post->id],
		'files' => true

	])!!}

	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
				{!! Form::label('title', 'Title:')  !!}
				{!! Form::text('title', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255'])  !!}
			</div>

			<div class="form-group">
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}
			</div>

			<div class="form-group">
				{{ Form::label('category_id', 'Category:') }}
				{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('tags', 'Tags:') }}
				{{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' =>'multiple']) }}
			</div>

			<div class="form-group">
				{{ Form::label('featured_image', 'Update Featured Image:') }}
				{{ Form::file('featured_image') }}
			</div>

			<div class="form-group">
				{!! Form::label('body', 'Body:')  !!}
				{!! Form::textarea('body', null, ['class' => 'form-control'])  !!}
			</div>
						
							
		</div>





			
		<div class="col-md-4">
			<div class="well">

				<dl class="dl-horizontal">
					<label>Url</label>
					<p><a href="{{ url($post->slug) }}">{{ url($post->slug) }}</a></p>
				</dl>


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

@section('scripts')

	{!! HTML::script('js/parsley.js') !!}
	{!! HTML::script('js/select2.min.js') !!}

	<script type="text/javascript">
		$('.select2-multi').select2();


		//set value using val, will trigger event called change, will set value to an array of individual values
		//use helper getRelatedIds to give us array of individual numbers from tags instead of pulling individually
		
		$('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');


		
	</script>



	
      
	
@endsection