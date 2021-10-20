<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\blog\Blog;
use App\Models\blog\Content;
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
        $this->tags = collect($this->tags)->unique();
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
            'tags' => $this->tags,
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

    /**
     * Recieves @param $slug
     * 
     * finds the corresponding blog and it's content
     * 
     * displays to user
     */
    public function show($slug)
    {
        return view('blog.show', [
            'blog' => Blog::where('slug', $slug)->first(),
            'tags' => $this->tags,
        ]);
    }

    /**
     * Recieves @param $blogId, $request
     * 
     * finds the corresponding blog and add it's content
     */
    public function addContent($id, Request $request)
    {
        dd($request->content . '+' . $request->type);
        Content::create([
            'blog_id' => $id,
            'type' => $request->type,
            'content' => $request->content,
        ]);
        return redirect()->back();
    }
}
