<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function category_post($topic)
	{
		//$posts = Posts::all();
		//echo var_dump($topic);
		//$postsWithTheCategory = $posts->wherePivot('name', "=", $topic)->first();

		//$category = Posts::where('name', $topic)->first;

		//echo var_dump($category);
		// $posts = Posts::where('name', $topic)->first();
		 
		/*$posts = Posts::with(array('categories' => function($query)
		{
		    $query->where('name', $topic); 
		}));*/

		//$posts = Posts::where('name',$topic)->orderBy('created_at','desc')->paginate(5);
		//
		//$category = Category::with('Posts')->where('name', '=', $topic)->get();
		
		$posts = Posts::whereHas('categories', function ($query) use($topic) { $query->where('name', '=', $topic)->where('status','published');})->paginate(5);
		//$postsPaginated = $posts->paginate(5);
		//$postsPaginated = \Paginator::make($posts, $posts->count(), 10);
		//echo var_dump($posts);

		return view('display.feed')->withPosts($posts)->withTitle($topic);
		//echo $posts;
/*
		$userComments = $group->comments()
   ->where('owner_id', $userId) // or comments.owner_id in case of ambiguity
   // you may want to eager load the threads
   // ->with('thread')
   ->get();

   		$categoryOfPosts = $group->postsOfCategory()->where('post_id', SA POSTS)->get(); */

/*
		$category= Category::with ('id')->get();

		$posts = Posts::get();

		$subset = $posts->map(function ($posts) {
    	return collect($posts->toArray())
        ->only(['id'])->where('id', $category)  ->all();
});*/
		//model post is from the clicked author that's published



/*		$posts = Posts::where('status','published')->categories->category_id->orderBy('created_at','desc')->paginate(5);
		//title is the model user's name . the ID is used to find the name
		//$title = User::find($id)->name;

		//return to view named home with variable named post equal to $posts
		return view('display.feed')->withPosts($posts);//->withTitle($title);
		*/
	}

}
