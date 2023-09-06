<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get doctors for major name Prof
        // inner join
        // first method
        // $doctors = Doctor::select('doctors.*', 'majors.title as major_name')
        //     ->join('majors', 'doctors.major_id', '=', 'majors.id')
        //     ->where('majors.title', 'Prof.')
        //     ->get();

        // second method

        $doctors = Doctor::whereHas('major', function ($q) {
            $q->where('title', 'Prof.');
        })->get();
        $major = Major::whereHas('doctors', function ($q) {
            $q->whereHas('rates', function ($query) {
                $query->select('doctor_id')->groupBy('doctor_id')->havingRaw('AVG(rate) > 3');
            });
        })->get();
        dd($major);
        return view('doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // pagination
        // laravel debug bar
        // collection
        // lazy loading and eager loading
        // many to many relation
        // authentication
        // middleware
        // authorization
        $majors = Major::get();
        return view('doctor.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            'email' => ['required', 'email', 'unique:doctors,email'],
            'password' => ['required', 'min:5', 'max:20'],
            'image' => ['required', 'image']
        ])->validate();
        $data['password'] = Hash::make($request->password);
        $path = $request->file('image')->store('public');
        $path = str_replace('public', 'storage', $path);
        $data['image'] = $path;
        Doctor::create($data);
        return redirect()->route('doctor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return view('doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Doctor::where('id', $id)->update($request->all());
        return redirect()->route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Doctor::where('id', $id)->delete();
        return redirect()->route('doctor.index');
    }
}
