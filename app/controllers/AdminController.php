<?php

class AdminController extends BaseController {

	protected $layout="adminmainLayout";


	public function index()
	{
		if(Auth::check())
		{
		if(Auth::user()->usertype=='admin' || Auth::user()->usertype=='super'){
			$noofpost=DB::table('blog')->join('users', 'users.id', '=', 'blog.uid')->select('*','blog.id as blogid','blog.created_at as postedon')->where('blog.verified','=',0)->get();

			$nooffaq=DB::table('faq')->join('users', 'users.id', '=', 'faq.uid')->select('*','faq.id as faqid','faq.created_at as postedon')->where('faq.verified','=',0)->get();

			$noofcomments=Comments::where('verified','=',0)->get();

			$noofforumtopics=Forum::where('verified','=',0)->get();

			$noofuser=User::where('active','=',0)->count();
			$data=array(
				'noofpost' => $noofpost,
				'nooffaq'=>$nooffaq ,
				'noofcomments'=>$noofcomments,
				'noofuser'=>$noofuser,
				'noofforumtopics'=>$noofforumtopics
			);
			$this->layout->content = View::make('admin.home',$data);
		}
		}
		else{
			$this->layout->content = View::make('users.login');
		}
		
	}


	public function getDashboard()
	{
		if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super'){
			$noofpost=DB::table('blog')->join('users', 'users.id', '=', 'blog.uid')->select('*','blog.id as blogid','blog.created_at as postedon')->where('blog.verified','=',0)->get();

			$nooffaq=DB::table('faq')->join('users', 'users.id', '=', 'faq.uid')->select('*','faq.id as faqid','faq.created_at as postedon')->where('faq.verified','=',0)->get();

			$noofcomments=Comments::where('verified','=',0)->get();
			$noofuser=User::where('active','=',0)->count();
			$noofforumtopics=Forum::where('verified','=',0)->get();
			$data=array(
				'noofpost' => $noofpost,
				'nooffaq'=>$nooffaq ,
				'noofcomments'=>$noofcomments,
				'noofuser'=>$noofuser,
				'noofforumtopics'=>$noofforumtopics

			);
			$this->layout->content = View::make('admin.home',$data);
		}
		
	}

	public function getShowallpost(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin' || Auth::user()->usertype=='super')
			{
				$approvedpost=DB::table('blog')->join('users', 'users.id', '=', 'blog.uid')->select('*','blog.id as blogid','blog.created_at as postedon')->where('blog.verified','=',1)->get();
				$data=array(
					'noofpost'=>$approvedpost
				);
				$this->layout->content = View::make('admin.approvedpost',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}

	}

	public function getAllnewlyblog(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$newpost=DB::table('blog')
				->join('users', 'users.id', '=', 'blog.uid')
				->select('*','blog.id as blogid','blog.created_at as postedon')
				->where('blog.verified','=',0)->get();
				$data=array(
					'noofpost'=>$newpost
				);
				$this->layout->content = View::make('admin.newpost',$data);	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}



	public function getAllnewlyfaq(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$newfaq=DB::table('faq')
				->join('users', 'users.id', '=', 'faq.uid')
				->select('*','faq.id as faqid','faq.created_at as postedon')
				->where('faq.verified','=',0)->get();
				$data=array(
					'nooffaq'=>$newfaq
				);
				$this->layout->content = View::make('admin.newfaq',$data);	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getShowallfaq(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$newfaq=DB::table('faq')
				->join('users', 'users.id', '=', 'faq.uid')
				->select('*','faq.id as faqid','faq.created_at as postedon')
				->where('faq.verified','=',1)->get();
				$data=array(
					'nooffaq'=>$newfaq
				);
				$this->layout->content = View::make('admin.newfaq',$data);	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getApprovrdtopics(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$noofforum=DB::table('forum')
				->join('users', 'users.id', '=', 'forum.uid')
				->select('*','forum.id as forumid','forum.created_at as postedon')
				->where('forum.verified','=',1)->get();
				$data=array(
					'noofforum'=>$noofforum
				);
				$this->layout->content = View::make('admin.approvedforum',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}

	public function getNewtopics(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$noofforum=DB::table('forum')
				->join('users', 'users.id', '=', 'forum.uid')
				->select('*','forum.id as forumid','forum.created_at as postedon')
				->where('forum.verified','=',0)->get();
				$data=array(
					'noofforum'=>$noofforum
				);
				$this->layout->content = View::make('admin.newforum',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}


	public function getAdduser(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				if(Auth::user()->usertype=='admin'){
					$data=array(
						'auth'=>0
					);
					$this->layout->content=View::make('admin.adduser',$data);
				}
				else if(Auth::user()->usertype=='super'){
					$data=array(
						'auth' =>1
					);
					$this->layout->content=View::make('admin.adduser',$data);
				}
				else{
					$data=array(
						'auth'=>0
					);
					$this->layout->content=View::make('admin.adduser',$data);
				}
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}




	public function postAdduser(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$validator = Validator::make(Input::all(), User::$rulesAdmin);
				if ($validator->passes()) 
				{
					$saveuser=new User();
					$saveuser->email=Input::get('email');
					$saveuser->firstname=Input::get('firstname');
					$saveuser->lastname=Input::get('lastname');
					$saveuser->password=Hash::make(Input::get('password'));
					$saveuser->usertype=Input::get('usertype');
					$saveuser->active=1;
					$saveuser->save();
					return Redirect::to('admin/adduser')->with('message', '<strong>Success</strong>User added');
				}
				else{
					return Redirect::to('admin/adduser')->with('message', '<strong>Oh no!</strong>Change a few things up and try submitting again')->withErrors($validator)->withInput();
				}
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}


	public function getUseradmin(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$getuser=User::where('usertype','=','admin')->orWhere('usertype','=','super')->paginate(1);
				$data=array('getuser' => $getuser);
				$this->layout->content=View::make('admin.listadmin',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getUsercommon(){
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$getuser=User::where('usertype','=','common')->paginate(1);
				$data=array('getuser' => $getuser);
				$this->layout->content=View::make('admin.listcommon',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getSiteinfo(){

		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$update=Siteinfo::get();
				foreach ($update as $key) {
					if($key->context_type=='aboutus')
					{
						$about=$key->about;
						$aboutid=$key->id;
					}
					else if($key->context_type=='home')
					{
						$home=$key->about;
						$homeid=$key->id;
					}
				}
				$data=array(
					'about'=>$about,
					'aboutid'=>$aboutid,
					'home'=>$home,
					'homeid'=>$homeid
					);
				$this->layout->content=View::make('admin.siteinfo',$data);	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}


	public function postAboutus()
	{
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$update=Siteinfo::find(Input::get('aboutid'));
				$update->about=Input::get('saveAboutus');
				$update->save();
				return Redirect::to('admin/siteinfo');
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function postHomecontent()
	{
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				$update=Siteinfo::find(Input::get('homeid'));
				$update->about=Input::get('saveHome');
				$update->save();
				return Redirect::to('admin/siteinfo');
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	
	public function getUploadimage()
	{
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
				//$getPhotos=Gallery::orderpaginate(2);
				$this->layout->content=View::make('admin.uploadimage');
			}
		else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}
	public function postUploadimage()
	{
		//$getPhotos=Gallery::orderpaginate(2);
		//$file = Input::file('files'); 
		//$getOriginalName=Input::file('files')->getClientOriginalName();
        if(Auth::check())
        {
	        if(Auth::user()->usertype=='admin' || Auth::user()->usertype=='super')
	        {
	        	if (Input::hasFile('image'))
				{
					$destinationPath = public_path().'/galleryimage/';	
		        
			        if (!file_exists($destinationPath)) {
					    mkdir($destinationPath, 0777, true);
					}

			        $ext = Input::file('image')->getClientOriginalExtension();//pathinfo($file[0], PATHINFO_EXTENSION);
					$filename = uniqid("galleryimage_").'.'.$ext;
			        $uploadSuccess   = Input::file('image')->move($destinationPath, $filename);
			        
				    $FileDB = new Gallery();
				    $FileDB->fname = $filename;
				    $FileDB->event_date =Input::get('eventdate');
				    $FileDB->filetitle = Input::get('title');
				    $FileDB->description = Input::get('desc');
				    //$FileDB->file_size = $getSize;
				    $FileDB->uploadedBy = Auth::user()->id;
				    $FileDB->save();

				    //return $FileDB->id;

					$this->layout->content=View::make('admin.uploadimage')->with('message','Successfully Uploaded !');
				}
				else
				{
					$this->layout->content=View::make('admin.uploadimage')->with('message','No file found !!');
				}
	        }
	        else
	        {
	        	return Redirect::to('users/login')->with('message','Un-Auhtorized Access');

	        }
		}
		else
		{
			return Redirect::to('users/login');
		}
        
	}

	public function getDelete($id)
	{
		if(Auth::check())
		{
		//$getPhotos=Gallery::orderpaginate(2);
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
			$getPost=Blog::find($id);
			$getPost->delete();
			
				$noofpost=DB::table('blog')->join('users', 'users.id', '=', 'blog.uid')->select('*','blog.id as blogid','blog.created_at as postedon')->where('blog.verified','=',0)->get();

				$nooffaq=DB::table('faq')->join('users', 'users.id', '=', 'faq.uid')->select('*','faq.id as faqid','faq.created_at as postedon')->where('faq.verified','=',0)->get();

				

				$data=array(
					'noofpost' => $noofpost,
					'nooffaq'=>$nooffaq ,
				);
				$this->layout->content = View::make('admin.home',$data);
			}
			else
			{
				return Redirect::to('/')->with('message',"Un-Authorized Access");
			}
		}
		else{
			return Redirect::to('/');
		}
		
	}

	public function getVerify($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->usertype=='admin'||Auth::user()->usertype=='super')
			{
					//$getPhotos=Gallery::orderpaginate(2);
					$getPost=Blog::find($id);
					$getPost->verified=1;
					$getPost->save();
					$newpost=DB::table('blog')
					->join('users', 'users.id', '=', 'blog.uid')
					->select('*','blog.id as blogid','blog.created_at as postedon')
					->where('blog.verified','=',0)->get();
					$data=array(
						'noofpost'=>$newpost
					);
					$this->layout->content = View::make('admin.newpost',$data);
			}
			else
			{
				return Redirect::to('/')->with('message',"Un-Authorized Access");
			}
		}
		else
		{
			return Redirect::to('/');
		}
		
	}


	public function getAllnewlycomment()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$noofcomments=DB::table('comment')
				->join('users', 'users.id', '=', 'comment.doneby')
				->select('*','comment.id as commentid','comment.updated_at as postedon')
				->where('comment.verified','=',0)->get();
				$data=array(
					'noofcomments'=>$noofcomments
				);
				$this->layout->content = View::make('admin.newcomments',$data);	
			}
			else
			{
				return Redirect::to('/')->with('message',"Un-Authorized Access");
			}
		}
		else
		{
			return Redirect::to('/');
		}

	}

	public function getAllnewlyforum()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$noofforum=DB::table('forum')
				->join('users', 'users.id', '=', 'forum.uid')
				->select('*','forum.id as forumid','forum.updated_at as postedon')
				->where('forum.verified','=',0)->get();
				$data=array(
					'noofforum'=>$noofforum
				);
				$this->layout->content = View::make('admin.allnewlyforum',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}

	
	public function postVerifycomment($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getComment=Comments::find($id);
				$getComment->verified=1;
				$getComment->save();
				return "";
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}


	public function postVerifyforum($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getComment=Forum::find($id);
				$getComment->verified=1;
				$getComment->save();
				return "";
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}


	public function postDeleteforum($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getComment=Forum::find($id);
				$getComment->delete();
				return "";
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function postDeletecomment($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getComment=Comments::find($id);
				$getComment->delete();
				return "";
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getAllnewuser()
	{
		if(Auth::user()){
			if(Auth::user()->usertype=='admin' || Auth::user()->usertype=='super')
			{
				$noofuser=User::where('active','=',0)->get();
				$data=array('noofuser'=>$noofuser);
				$this->layout->content = View::make('admin.newuser',$data);	
			}
			else
			{
				return Redirect::to("/")->with('message','Un-Authorized Access');
			}
		}
		else
		{
			return Redirect::to('users/login')->with('message','login to coninue');
		}
	}


	
	public function postUserverify($id)
	{
		if(Auth::user()){
			if(Auth::user()->usertype=='admin' || Auth::user()->usertype=='super')
			{
				$updateuser=User::find($id);
				$updateuser->active=1;
				$updateuser->save();
				return 1;
			}
			else
			{
				return Redirect::to("/")->with('message','Un-Authorized Access');
			}
		}
		else
		{
			return Redirect::to('users/login')->with('message','login to coninue');
		}
	}

	public function getAddnews()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$data=array(
					'operation'=>'new'
				);
				$this->layout->content = View::make('admin.addnews',$data);	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function postCreatenews()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$newnews=new News();
				$newnews->news=Input::get('title');
				$newnews->newsdesc=Input::get('body');
				$newnews->news_date=Input::get('newsdate');
				$newnews->created_by=Auth::user()->id;
				$newnews->save();
				$data=array(
					'operation'=>'new'
				);
				$this->layout->content = View::make('admin.addnews',$data)->with('message','Posted Successfully !');
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}

	public function getAddevents()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$data=array(
					'operation'=>'new'
				);
				$this->layout->content = View::make('admin.addevents',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}
	public function getEvents()
	{
		
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getallevents=Events::paginate(3);
				$data=array(
					'getallevents'=>$getallevents
					);
				$this->layout->content = View::make('admin.events',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}
	public function getNews()
	{
		
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getallnews=News::paginate(3);
				$data=array(
					'getallnews'=>$getallnews
					);
				$this->layout->content = View::make('admin.news',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}	
	}
	public function postCreateevent()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$event=new Events();
				$event->event_title=Input::get('title');
				$event->event_desc=Input::get('body');
				$event->event_date=Input::get('eventsdate');
				$event->created_by=Auth::user()->id;
				$event->save();
				$data=array(
					'operation'=>'new'
				);
				$this->layout->content = View::make('admin.addevents',$data)->with('message','Posted Successfully !');	
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getGallery(){
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$getbyyear=DB::table('gallery')->select('eyear')->distinct('eyear')->get();
				//var_dump($getbyyear);exit;
				$data=array('getbyyear'=>$getbyyear);
				$this->layout->content = View::make('admin.gallery',$data);
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function postImage()
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
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
    	else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('users/login');
		}
	}

	public function getBlogdisplay($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$blog=DB::table('blog')
				->join('users','users.id','=','blog.uid')
				->select('*','blog.id as postid')
				->where('blog.id','=',$id)
				->get();
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('error');
		}

		if(count($blog))
		{
			$getallcomment=DB::table('comment')
			->join('users','users.id','=','comment.doneby')
			->select('*','comment.updated_at as commenton')
			->where('comment.context','=','blog')
			->where('comment.contextid','=',$id)
			->where('comment.verified','=',1)
			->get();
			$data=array(
				'blog'=>$blog,
				'getallcomment'=>$getallcomment,
				'postid'=>$id
				);
			$this->layout->content = View::make('blog.display',$data);
		}
		else
		{
			return Redirect::to('error');
		}
	}

	public function getFaqdisplay($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$faq=DB::table('faq')
				->join('users','users.id','=','faq.uid')
				->select('*','faq.id as postid')
				->where('faq.id','=',$id)
				->get();
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('error');
		}

		if(count($faq))
		{
			$getallcomment=DB::table('comment')
			->join('users','users.id','=','comment.doneby')
			->select('*','comment.updated_at as commenton')
			->where('comment.context','=','faq')
			->where('comment.contextid','=',$id)
			->where('comment.verified','=',1)
			->get();
			$data=array(
				'faq'=>$faq,
				'getallcomment'=>$getallcomment,
				'postid'=>$id
				);
			$this->layout->content = View::make('faq.display',$data);
		}
		else
		{
			return Redirect::to('error');
		}
	}

	public function getForumdisplay($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->type="admin"||Auth::user()->type="super")
			{
				$forum=DB::table('forum')
				->join('users','users.id','=','forum.uid')
				->select('*','forum.id as postid')
				->where('forum.id','=',$id)
				->get();
			}
			else
			{
				return Redirect::to('error');
			}
		}
		else
		{
			return Redirect::to('error');
		}

		if(count($forum))
		{
			$getallcomment=DB::table('comment')
			->join('users','users.id','=','comment.doneby')
			->select('*','comment.updated_at as commenton')
			->where('comment.context','=','forum')
			->where('comment.contextid','=',$id)
			->where('comment.verified','=',1)
			->get();
			$data=array(
				'forum'=>$forum,
				'getallcomment'=>$getallcomment,
				'postid'=>$id
				);
			$this->layout->content = View::make('forum.display',$data);
		}
		else
		{
			return Redirect::to('error');
		}
	}
}
