<?php

namespace App\Http\Controllers;

use App\Models\StdAtt;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class StdAttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index', [
            'atts' => StdAtt::all(),
            'stds' => array_unique(StdAtt::pluck('name')->toArray())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->validation === Env::get('IDENTITY')) {
            $att = StdAtt::create([
                'name' => $request->name,
                'att_date' => $request->att_date,
                'payment' => $request->payment,
            ]);
            return redirect(route('attendances.index'))->with('success', 'Attendance added!')->with('id', $att->id);
        }
        return redirect(route('attendances.index'))->with('fail', 'Attendance failed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StdAtt  $stdAtt
     * @return \Illuminate\Http\Response
     */
    public function show($student)
    {
        return view('student.single_att', [
            'student' => StdAtt::where('name', $student)->get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StdAtt  $stdAtt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, StdAtt $stdAtt)
    {
        $name = $stdAtt->name;

        if ($request->validation === Env::get('IDENTITY')) {
            $stdAtt->delete();
        }

        return redirect(route('attendances.show', $name));
    }
}
