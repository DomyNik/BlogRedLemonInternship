<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Posts;
use App\Category;
use App\Expertise;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use DB;


class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function write()
    {
    	// $category_items = Category::all();
     //   $old_categories= $post->categories;
        $category_items = Category::all();

    	return view('summernote')->withCategory_items($category_items);//->withCategory_items($category_items)->withOld_categories($old_categories);
    }

     public function profile($id)
    {
      $author = User::where('id',$id)->first();
      $user=$author;
      $posts = Posts::where('author_id', $id);
      $expertise_items = Expertise::all();
      $old_expertise= $user->expertises;
      $posts_count = $posts->count();
      $posts_published_count = $posts->where('status', 'published')->count();
      $posts_draft_count = $posts->where('status', 'draft')->count();
      
       $title =Auth::user()->firstname;
       return view ('display.profile')->withTitle($title)->withUser($user)->withPosts($posts)->withPosts_count($posts_count)->withAuthor($author)->withPosts_published_count($posts_published_count)->withPosts_draft_count($posts_draft_count)->withExpertise_items($expertise_items)->withOld_expertise($old_expertise);
    }

    public function profile_update(Request $request, $id)
    {
    	//$post_id = $request->input('post_id');

    	  $expertises = Input::get('expertise');
        $user = User::where('id',$id)->first();
        // $user = User::whereHas('expertises', function($query) use ($id) { $query->where('id', '=', $id);});
        //dd ($user);
          //dd ($data);
          //echo $id;
        //echo ($user);
        //dd ($user->expertises());
        $user->expertises()->sync([]);
        $user->expertises()->sync($expertises);
         $message='Expertise updated';
         $landing='profile/'.$id;
         return redirect($landing)->withMessage($message);
        
    }


 
	public function myPosts()
	{
		$title="My Posts";
		$id = Auth::user()->id;
		$posts = Posts::where('author_id',$id)->where('status','published')->orderBy('created_at','desc')->paginate(5);

		//$post = Posts::find(31);
		//$posts = Posts::all();
		//$categories = Category::all();
		//echo $post->categories;
		/*foreach ($posts as $post) {
			echo $post->wherePivot('name','love');
		}*/
		


		//$title = User::find($id)->name;

		//return to view named home with variable named post equal to $posts
		return view('display.feed')->withPosts($posts)->withTitle($title);
	}

	public function destroy(Request $request, $id)
	{
		//
		$post = Posts::find($id);
		if($post && ($post->author_id == $request->user()->id || $request->user()->is_editor()))
		{
			$post->delete();
			$data['message'] = 'Post deleted Successfully';
		}
		else 
		{
			$data['errors'] = 'Invalid Operation. You have not sufficient permissions';
		}
		
		return redirect('/')->with($data);
	}
}
