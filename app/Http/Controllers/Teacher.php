<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Teacher as ModelsTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Teacher extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $teacher = ModelsTeacher::with('user')->where('user_id', $userId)->first();
        $permits = Permit::whereHas('user', function ($query) use ($userId) {
            $query->where('role', 'guru')->where('id', $userId);
        })->get();
        // dd($teachers);
        return view('teacher.index', compact('permits', 'teacher'));
    }

    public function create()
    {
        return view('teacher.create');
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

        return redirect()->route('teacher.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(ModelsTeacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, ModelsTeacher $teacher)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'nip' => 'required|string|max:20|unique:teachers,nip,' . $teacher->id,
        //     'tanggal_mulai' => 'required|date',
        //     'keterangan' => 'required|string|max:255',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // $imagePath = $teacher->image;
        // if ($request->hasFile('image')) {
        //     if ($teacher->image) {
        //         Storage::disk('public')->delete($teacher->image);
        //     }
        //     $imagePath = $request->file('image')->store('images', 'public');
        // }

        // $teacher->update($request->only(['nama', 'nip']));

        // $teacher->permit()->updateOrCreate(
        //     ['user_id' => $teacher->id],
        //     [
        //         'tanggal_mulai' => $request->tanggal_mulai,
        //         'keterangan' => $request->keterangan,
        //         'image' => $imagePath,
        //     ]
        // );

        // return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(ModelsTeacher $teacher)
    {
        // if ($teacher->image) {
        //     Storage::disk('public')->delete($teacher->image);
        // }
        // $teacher->delete();
        // return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully.');
    }

    
}
