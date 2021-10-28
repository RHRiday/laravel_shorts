<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Models\Blogs\Blog;
use App\Models\Blogs\Content;
use App\Models\Blogs\Tag;
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
    public function index($parameter = null, $query = null)
    {
        $data = Blog::orderByDesc('created_at')->get();

        if ($parameter) {
            switch ($parameter) {
                case 'tag':
                    $data = [];
                    $collection = Tag::where('tag', $query)->get();
                    foreach ($collection as $tag) {
                        array_push($data, $tag->blog);
                    }
                    break;
                case 'user':
                    $data = $data->where('user_id', $query);
                    break;
                default:
                    if ($query == null) {
                        return $this->show($parameter);
                    } else {
                        abort(404);
                    }
                    break;
            }
        }

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
    public function create(CreateBlogRequest $request)
    {
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => Auth::id(),
        ]);

        foreach ($request->tags as $tag) {
            Tag::create([
                'tag' => str_replace('/\s+/', '', ucwords($tag)),
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
            'blog' => Blog::where('slug', $slug)->firstOrFail(),
            'tags' => $this->tags,
        ]);
    }

    /**
     * Recieves @param $blogId, $request
     * 
     * finds the corresponding blog
     * 
     * adds it's content
     */
    public function addContent($id, Request $request)
    {
        $data = Content::create([
            'blog_id' => $id,
            'type' => $request->type,
            'content' => $request->content,
        ]);

        return response()->json($data);
    }

    /**
     * Recieves @param $contentID, $request
     * 
     * finds the corresponding blog content
     * 
     * updates it's content
     */
    public function editContent($id, Request $request)
    {
        $content = Content::findOrFail($id);

        $content->update([
            'content' => $request->content,
        ]);

        $data = $content;

        return response()->json($data);
    }

    /**
     * Recieves @param $blog
     * 
     * finds the corresponding blog
     * 
     * deletes it
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect('/dokkoblog');
    }

    /**
     * Recieves @param $content
     * 
     * finds the corresponding blog content
     * 
     * deletes the content
     */
    public function deleteContent(Content $content)
    {
        $data = $content->delete();

        return response()->json($data);
    }
}
