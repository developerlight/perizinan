<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class CrudStudent extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::with('student')->where('role', 'siswa')->get();
        // dd($students);
        return view('admStudent.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admStudent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'kelas' => 'required|string|max:20',
        ]);
        // dd($request->all());
        // Buat user baru
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Buat student terkait
        Student::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return to_route('siswa.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $student = Student::with('user')->find($id);
        // dd($student);
        return view('admStudent.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         // Temukan user berdasarkan ID
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:siswa',
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20',
            'kelas' => 'required|string|max:20',
        ]);

        $user->update([
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);
        // dd($user);
        // Temukan atau buat data teacher terkait
        $student = Student::firstOrNew(['user_id' => $user->id]);
        $student->nama = $request->nama;
        $student->nis = $request->nis;
        $student->kelas = $request->kelas;
        $student->save();

        return to_route('siswa.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $student = Student::findOrFail($id);
        $user = User::findOrFail($student->user_id);
        // dd($student);
        $user->delete();
        $student->delete();
        return redirect()->route('siswa.index')->with('success', 'User deleted successfully.');
    }
}
