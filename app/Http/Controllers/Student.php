<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Student as ModelsStudent;
use Illuminate\Http\Request;

class Student extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        // dd($userId);
        $student = ModelsStudent::with('user')->where('user_id', $userId)->first();
        // dd($student);
        $permits = Permit::whereHas('user', function ($query) use ($userId) {
            $query->where('role', 'siswa')->where('id', $userId);
        })->get();
        return view('student.index', compact('permits', 'student'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Permit::create([
            'user_id' => auth()->id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'keterangan' => $request->keterangan,
            'img' => $imagePath,
        ]);

        return redirect()->route('student.index')->with('success', 'Student created successfully.');
    }

    public function edit(ModelsStudent $student)
    {
        // return view('students.edit', compact('student'));
    }

    public function update(Request $request, ModelsStudent $student)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'nis' => 'required|string|max:20|unique:students,nis,' . $student->id,
        //     'kelas' => 'required|string|max:50',
        // ]);

        // $student->update($request->all());

        // return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(ModelsStudent $student)
    {
        // $student->delete();
        // return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
