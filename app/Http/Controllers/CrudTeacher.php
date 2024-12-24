<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class CrudTeacher extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::with(['teacher'])->where('role', 'guru')->get();
        // dd($teachers);
        return view('admTeach.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admTeach.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'nama' => 'required|string|max:255',
            'nip' => 'string|max:20',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        // dd($user);
        Teacher::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nip' => $request->nip,
        ]);

        return to_route('teach.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        // dd($teacher);
        return view('admTeach.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Temukan user berdasarkan ID
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
        ]);

        // Update data user jika ada perubahan
        $user->update([
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        // Temukan atau buat data teacher terkait
        $teacher = Teacher::firstOrNew(['user_id' => $user->id]);
        $teacher->nama = $request->nama;
        $teacher->nip = $request->nip;
        $teacher->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('teach.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // dd($id);
        $teacher = Teacher::findOrFail($id);
        $user = User::findOrFail($teacher->user_id);
        // dd($teacher);
        $user->delete();
        $teacher->delete();
        return redirect()->route('teach.index')->with('success', 'User deleted successfully.');
    }
}
