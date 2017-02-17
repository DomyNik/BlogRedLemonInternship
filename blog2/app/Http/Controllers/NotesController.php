<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Http\Requests;
use DB;
use App\Posts;
use App\Expertise;
use App\User;
use App\Category;
use App\Category_post;
use Carbon\Carbon;

class NotesController extends Controller
{

    public function user_posts($id)
    {

        //model post is from the clicked author that's published
        $posts = Posts::where('author_id',$id)->where('status','published')->orderBy('created_at','desc')->paginate(5);
        //title is the model user's name . the ID is used to find the name
        $title = User::find($id)->firstname."'s"." Posts";

        //return to view named home with variable named post equal to $posts
        return view('display.feed')->withPosts($posts)->withTitle($title);
    }

    
    public function index()
    {
        $posts = Posts::where('status','published')->orderBy('created_at','desc')->paginate(5);
        $title = 'Latest Posts';
        $categories = Category::all();
       //$category_post = Category_post::all();//error here
        return view('display.feed')->withPosts($posts)->withTitle($title);//->withCategories($categories)->withCategory_post($category_post);
    	//return view('display.feed');
    }

    public function insert(Request $request)
    {
        //idk if needed
    	$user = Auth::user();

        //create new model Post
        $post = new Posts();

        //capture the details
        $post->author_id = $request->user()->id;
        $post->title = $request->get('title');
        $post->contents = $request->get('summernote');
        $post->slug = str_slug($post->title);
        if ($request->has('publish'))
        {
            $post->status ='published';
            $message = 'Post published successfully';
        }

        else if ($request->has('draft'))
        {
            $post->status ='draft';
            $message = 'Draft saved successfully';
        }

        else if ($request->has('pending'))
        {
            $post->status ='pending';
            $message = 'Post is now pending';
        }

            /*
    	DB::table('posts')->insert([

    		'title'=>$request['title'],
    		'contents'=>$request['summernote'],
    		'author_id'=>Auth::user()->id,
    		'status'=>$post_status,
            'created_at'=>$mytime
            ]);*/
            $post->save();

            $categories = $request->input('categories');
            if(is_array($categories))
            {
            //echo "got in";
                foreach ($categories as $category) {
                 DB:: table('category_post')->insert([
                    "category_id" =>$category,
                    "post_id" => $post->id
                    ]);
             }
           // $post->categories()->attach($request->input('category'));
         } 
         $title= $post->title;
         // if($request->has('publish'))
         //    {
         //        $message = 'Post saved successfully';
         //        $landing = $post->slug;
         //    } 
         //    
          $category_items = Category::all();
         if ($post->status == 'draft')
         {
            $landing = 'draft/'.$post->slug;
            return redirect($landing)->withMessage($message)->withPost($post)->withTitle($title);
        }
        $landing = $post->slug;
        
            return redirect($landing)->withMessage($message)->withPost($post)->withTitle($title);
    	//return back();
    	//return view('welcome');
    }

    public function viewMyPosts()
    {
        $title = 'Your Posts';
        //$data=DB::table('posts')->get();
        $posts = Posts::all();
        //return view('posts.terminator', compact ('data'))->withTitle($title)
        return view('posts.terminator')->withTitle($title)->withPosts($posts);
    }

    public function edit(Request $request,$slug)
    {
        //once the slug is found, stop the search and send back the result
        $post = Posts::where('slug',$slug)->first();

        //get all categories model
        //$categories = Category::all();
       // $boolean = true;
       // $category_id = 1;
       // $category_boolean = Category::where('post_id',$request->input('post_id'))->where('category_id', $category_id);

        $category_items = Category::all();
        $old_categories= $post->categories;
        // $categories = Category::whereHas('posts', function($query) { $query->where('post_id', '=', $post->id);});

        /*if the request comes from the author himself or
        if the request comes from a user who's an editor*/
            if($post && ($request->user()->id == $post->author_id || $request->user()->is_editor()))
            {
                return view('posts.edit')->with('post',$post)->withCategory_items($category_items)->withOld_categories($old_categories);//->withBoolean($boolean);
            } 
            else 
            {
                return redirect('/')->withErrors('you have not sufficient permissions');
            }
        }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {

         // get the primary key of post 
        $post_id = $request->input('post_id');
        $originalSlug = $request->input('slug');
        // get the model with the primary key taken from HTML
        $post = Posts::find($post_id);

      //dd ($originalSlug);
        if($post && $request->user()->is_editor())
        {
            
           $category_checked = $request->input('category');
          // $this->validate($request, ['category_checked' => 'min:1']);
            //dd ($request->categories);
           // if($category_checked)
           // {
           //       foreach ($category_checked as $category_check) {
           //         DB:: table('category_post')->insert([
           //          "category_id" =>$category_check,
           //          "post_id" => $post->id
           //          ]);
           //          }  
           //     // $post->categories()->attach($request->input('category'));
           //  }
           //dd ($request->categories);
           //$post->save();
           $post->categories()->sync([]);
              $post->categories()->sync($request->categories);
              //dd ($post);
        } //get title, slug, and the model that has the selected slug taken from HTML

       $title = $request->input('title');
       $slug = str_slug($title);
       $duplicate = Posts::where('slug',$slug)->first();
       //dd ($slug);
                //if the Post model exists
       if($duplicate)
                {   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    // if the primary key of the model is not the same as the primary key of the derived primary key from HTML
                    if($duplicate->id != $post_id)
                    {
                      $message='The title already exists!';
                        return redirect('edit/'.$slug)->withMessage($message);
                    }
                }
                  $post->slug = $slug;
            // title of the model is the title derived from the HTML
                $post->title = $title;

            // contents of the post will be taken from the HTML file with input summernote
                $post->contents = $request->input('summernote');

                if($request->has('save'))
                {
                    $post->status = 'draft';
                    $message = 'Draft saved successfully';
                    $landing = 'draft/'.$post->slug;
                }  
                if($request->has('pending'))
                {
                    $post->status = 'pending';
                    $message = 'Post now pending';
                    $landing = 'draft/'.$post->slug;
                }            
                else {
                    $post->status = 'published';
                    $message = 'Post updated and published successfully';
                    $landing = $post->slug;
                }

            //$post->categories()->attach($request->input('category_id'));

                $post->save();
             // \Session::flash('flash_message','Office successfully added.'); 
                return redirect($landing)->withMessage($message);
            

        }

    public function draft($slug)
    {
        //stop searching only when the slug is found
        $post = Posts::where('slug',$slug)->first();
        $message = 'Draft saved';
        if($post)
        {
            $title = $post->title;

            //$comments = $post->comments;    
        }
        else 
        {
            
            return redirect('/')->withErrors('requested page not found');
        }
        
        return view('posts.show')->withPost($post)->withTitle($title)->withMessage($message);
        //->withComments($comments);
    }

    public function show($slug)
    {
        //stop searching only when the slug is found
        $post = Posts::where('slug',$slug)->first();
        if($post)
        {
            $title = $post->title;

            if($post->status == 'draft')
            {
                echo 'huy';
                //return redirect('/')->withErrors('requested page not found');
            }
            //$comments = $post->comments;    
        }
        else 
        {
            return redirect('/')->withErrors('requested page not found');
        }
        
        return view('posts.show')->withPost($post)->withTitle($title);
        //->withComments($comments);
    }


    public function authorToExpertise()
    {

      $users = User::all();
      $title ="Author's Expertise";
      $expertises = Expertise::all();
      return view('display.authorToExpertiseTable')->withTitle($title)->withUsers($users)->withExpertises($expertises);
    }

    public function expertiseToAuthor()
    {

      $users = User::all();
      $title ="Author's Expertise";
      $expertises = Expertise::all();
      return view('display.expertiseToAuthorTable')->withTitle($title)->withUsers($users)->withExpertises($expertises);
    }


}
