<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\faq\Question;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Collects all the FAQ information
     * 
     * return the corresponding view
     */
    public function index()
    {
        return view('apps.faq',[
            'faqs' => Question::all()->sortBy('question'),
            'uniqueTag' => array_unique(Question::pluck('tag')->toArray())
        ]);
    }

    /**
     * @param Request $request
     * 
     * creates an entry to the table
     * 
     * return @model Question
     */
    public function create(Request $request)
    {
        $data = Question::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'tag' => strtolower($request->tag),
        ]);

        return response()->json($data);
    }
}
