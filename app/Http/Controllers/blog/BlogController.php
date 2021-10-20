<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\blog\Blog;
use App\Models\blog\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    private $tags = [];

    public function __construct()
    {
        foreach (Blog::all() as $blog) {
            foreach ($blog->tags as $tag) {
                array_push($this->tags, $tag->tag);
            }
        }
    }

    /**
     * Collects blogs from database and display to user
     * 
     * the home page of DokkoBlog
     */
    public function index()
    {
        $data = Blog::orderByDesc('created_at')->get();
        return view('blog.home', [
            'blogs' => $data,
            'tags' => collect($this->tags)->unique(),
        ]);
    }

    /**
     * Recieves @param $request
     * 
     * process request and store to database
     * 
     * Creates a blog
     */
    public function create(Request $request)
    {
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id(),
        ]);

        foreach($request->tags as $tag) {
            Tag::create([
                'tag' => $tag,
                'blog_id' => $blog->id,
            ]);
        }

        return redirect('/dokkoblog')->with('success');
    }
}
