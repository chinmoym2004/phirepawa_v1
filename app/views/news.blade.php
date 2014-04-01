@foreach($getallnews as $news)
	<div>
		{{$news->news}}<br/>
		{{$news->newsdesc}}<br/>
		{{$news->news_date}}
		<a href="{{url('fullnews?forwhich='.base64_encode($news->id))}}">More...</a><br/><br/>
	</div>
@endforeach
<?php echo $getallnews->links(); ?>