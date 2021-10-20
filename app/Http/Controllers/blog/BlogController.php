<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\blog\Blog;

class BlogController extends Controller
{
    private $tags = [];

    public function __construct()
    {
        foreach(Blog::all() as $blog) {
            foreach ($blog->tags as $tag){
                array_push($tags, $tag);
            }
        }    
    }

    public function index()
    {
        $data = Blog::orderByDesc('created_at')->get();
        return view('blog.home', [
            'posts' => $data,
            'tags' => $this->tags,
        ]);
    }
}
