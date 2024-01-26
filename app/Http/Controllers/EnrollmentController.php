<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Batch;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        
        $enrollment= Enrollment::all();
        return view('enrollments.index')->with('enrollments',$enrollment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::pluck('id','name');
        $students = Student::pluck('id','name');
        return view('enrollments.create', compact('batches','students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $input= $request->all();
        Enrollment::create($input);
        return redirect('enrollments')->with('flash_message','Enrollment Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollment = Enrollment::find($id);
        return view('enrollments.show')->with('enrollments', $enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $batches = Batch::pluck('id','name');
        $students = Student::pluck('id','name');
        $enrollments = Enrollment::find($id);
        return view('enrollments.edit', compact('batches','students'))->with('enrollments',$enrollments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::find($id);
        $input = $request->all();
        $enrollment->update($input);
        return redirect('enrollments')->with('flash_message', 'Enrollment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Enrollment::destroy($id);
        return redirect('enrollments')->with('flash_message', 'Enrollment deleted!');
    }
}
