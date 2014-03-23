<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	protected $layout="mainLayout";

	public function index()
	{
		$update=Siteinfo::where('context_type','=','home')->get();
		foreach ($update as $key) {
			$home=$key->about;
		}
		$getallevents=Events::orderBy('updated_at','DESC')->get();
		$data=array(
			'home'=>$home,
			'getallevents'=>$getallevents
			);
		$this->layout->content = View::make('index',$data);
	}

	public function aboutus(){
		$getAbout=DB::table('siteinfo')->get();
		$data=array('getAbout'=>$getAbout);
		$this->layout->content = View::make('aboutus',$data);
	}
	public function myprofile(){
		$this->layout->content = View::make('myprofile');
	}

	public function comment(){
		//print_r($_REQUEST);
		$getComment=new Comments();
		$getComment->combody=Input::get('postcomment');
		$getComment->context=Input::get('context');
		$getComment->doneby=Auth::user()->id;
		$getComment->contextid=Input::get('forid');
		$getComment->verified=0;
		$getComment->save();
		return "";
	}

	public function error(){
		$this->layout->content = View::make('error');
	}

	public function contactus(){
		$this->layout->content = View::make('contactus');
	}

	public function gallery(){
		$getbyyear=DB::table('gallery')->select('eyear')->distinct('eyear')->get();
		//var_dump($getbyyear);exit;
		$data=array('getbyyear'=>$getbyyear);
		$this->layout->content = View::make('gallery',$data);
	}

	public function postImage()
	{
		$getlastyearpics=Gallery::where('eyear','=',Input::get('yr'))->get();
		$tmp='';
		foreach($getlastyearpics as $val)
		{
        	$tmp.='<a href="'.public_path().'/galleryimage/'.$val->fname.'" title="'.$val->filetitle.'" data-gallery>
            <img src="'.public_path().'/galleryimage/'.$val->fname.'" alt="'.$val->filetitle.'"></a>';
    	}
    	return $tmp;
	}

	public function news()
	{
		$getallnews=News::paginate(3);
		$data=array(
			'getallnews'=>$getallnews
		);
		$this->layout->content = View::make('news',$data);
	}


	public function fullnews()
	{
		
		$getnews=News::find(base64_decode($_REQUEST['forwhich']));
		if(count($getnews))
		{
			$data=array(
				'getnews'=>$getnews
			);
			$this->layout->content = View::make('displaynews',$data);
		}
		else
		{
			return Redirect::to('/')->with('message','Invalid Request !');
		}
	}
	

}
