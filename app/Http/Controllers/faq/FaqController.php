<?php

namespace App\Http\Controllers\faq;

use App\Http\Controllers\Controller;
use App\Models\faq\Question;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return view('apps.faq',[
            'faqs' => Question::all()->sortBy('question')
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
            'tag' => $request->tag,
        ]);

        return response()->json($data);
    }
}
