<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    //
    function index()
    {
        $majors = Major::get();
        return view('major.index', compact('majors'));
    }
    function destroy($id)
    {
        $major = Major::find($id);
        $major->delete();
        return redirect('/majors');
    }
    public function show(Major $major)
    {
        return view('major.show', compact('major'));
    }
    function edit($id)
    {
        $major = Major::find($id);
        return view('major.update', ['major' => $major]);
    }
    function update(Request $request, $id)
    {
        // $major = Major::find($id);
        // #1
        // $major->update(['title' => $request->title]);
        // #2
        // $major->title  = $request->title;
        // $major->save();
        // #3
        Major::where('id', $id)->update(['title' => $request->title]);
        return redirect()->route('major.index');
    }
    function create()
    {
        return view('major.create');
    }
    function store(Request $request)
    {
        Major::create(['title' => $request->title]);
        return redirect()->route('major.index');
    }
}
