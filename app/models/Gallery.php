<?php 
class Gallery extends Eloquent{ 
	
	public static $rules = array(
	   'fname'=>'mimes:jpeg,png|max:1024'
	);
	protected $table = 'gallery';
}	





