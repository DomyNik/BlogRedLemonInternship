<?php

namespace App\Http\Controllers;
use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class UnpublishedController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

	 public function executeUnpublished($command)
    {
       // echo $command;
       $id = Auth::user()->id;
      
       return $posts = Posts::where('status',$command)->where('author_id', $id)->orderBy('created_at','desc')->paginate(5);
        //$title = 'Latest Posts';

     //   echo var_dump($command);
        //echo 'asd';
        //$categories = Category::all();
        //$category_post = Category_post::all();
      //  return view('display.feed')->withPosts($posts);//->withTitle($title);//->withCategories($categories)->withcategory_post($category_post);
    	//return view('display.feed');
    }

    public function drop()
    {

      return view('drop');
    }


    public function drafts()
    {
        //$posts = Posts::where('status','drafts')->orderBy('created_at','desc')->paginate(5);
        //$title = 'Drafts';
        $command ='draft';
         $title = 'Drafts';
        $posts= $this->executeUnpublished($command);

        return view('display.feed')->withPosts($posts)->withTitle($title);
       // $categories = Category::all();
        //$category_post = Category_post::all();
       // return view('display.feed')->withPosts($posts)->withTitle($title)->withCategories($categories)->withcategory_post($category_post);
    	//return view('display.feed');
    }

     public function myPendingIndex()
    {
         $command ='pending';
          $title = 'My Pending Posts';
          $posts= $this->executeUnpublished($command);
          if (Auth::user()->is_editor())
          {
           $title ='Editors can publish directly';
          }
          return view('display.feed')->withPosts($posts)->withTitle($title);
       // $posts = Posts::where('status','published')->orderBy('created_at','desc')->paginate(5);
       // $title = 'Latest Posts';
       // $categories = Category::all();
       // $category_post = Category_post::all();
       // return view('display.feed')->withPosts($posts)->withTitle($title)->withCategories($categories)->withCategory_post($category_post);
    	//return view('display.feed');
    }

    public function pendingPosts()
    {
        $title = 'Pending Posts';
         $posts = Posts::where('status','pending')->orderBy('created_at','desc')->paginate(5);
          return view('display.feed')->withPosts($posts)->withTitle($title);
    }
}
