<?php

namespace App\Http\Controllers;
use App\Post;
use App\PostImage;
use App\Category;
use Auth;
use Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts(){
        $posts = Post::with('post_images')->orderBy('created_at','desc')->get();
        return response()->json(['error'=>false , 'data'=> $posts]);
    }

    public function createPost(Request $request){
        if(Auth::check()){
            $title = $request->title;
            $content = $request->content;
            $user = auth()->user();   
            $images = $request ->images;
            $post = Post::create([
                'title' => $title,
                'content' => $content,
                'user_id' => $user->id
            ]);
    
            //storing image
                $path = Storage::disk('uploads')->put($user->email . '/posts' .$post->id ,$images);
                PostImage::create([
                    'post_id' => $post->id,
                    'caption' => $title,
                    'image_path' => 'uploads/' .$path
                ]);
            
            $category = Category::find([1,2]);
            $post->category()->attach($category);
            return response()->json(['error'=>false, 'data'=>$post]);  
        }
        
    }
    public function getByCategory($category_id){
        $category = Category::find($category_id);
        $category->posts;
    }
}
