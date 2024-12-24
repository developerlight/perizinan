<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;


class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ModelsUser::with(['student', 'teacher', 'admin']);

        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->get();
        // dd($users);
        return view('users.index', compact('users'));
    }

    public function indexTeachers()
    {
        $teachers = ModelsUser::with(['teacher'])->where('role', 'guru')->get();
        // dd($teachers);
        return view('users.index_teachers', compact('teachers'));
    }

    public function storeTeachers(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'nama' => 'required|string|max:255',
            'nip' => 'string|max:20',
        ]);

        $user = ModelsUser::create([
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

        return to_route('users.teachers')->with('success', 'User created successfully.');
    }

    public function editTeachers(Teacher $teacher)
    {
        return view('users.edit', compact('teacher'));
    }
    /**
     * Display a listing of students.
     */
    public function indexStudents()
    {
        $students = ModelsUser::with('student')->where('role', 'siswa')->get();
        return view('users.index_students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
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
            'nis' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:50',
            'nip' => 'nullable|string|max:20',
        ]);

        $user = ModelsUser::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        // dd($user);

        // Create related model based on role
        switch ($request->role) {
            case 'siswa':
                Student::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'nis' => $request->nis,
                    'kelas' => $request->kelas,
                ]);
                break;
            case 'guru':
                Teacher::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'nip' => $request->nip,
                ]);
                break;
            case 'admin':
                Admin::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                ]);
                break;
        }

        return to_route('users.index')->with('success', 'User created successfully.');
    }

    public function updateTeacher(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'sometimes|nullable|min:6',
            'nip' => 'required',
            'nama' => 'required',
        ]);

        // Temukan user berdasarkan ID
        $user = ModelsUser::findOrFail($id);

        // Update data user
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();

        // Temukan atau buat data teacher terkait
        $teacher = Teacher::firstOrNew(['user_id' => $user->id]);
        $teacher->nip = $validated['nip'];
        $teacher->nama = $validated['nama'];
        $teacher->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.teachers')->with('success', 'Teacher updated successfully.');
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
    public function edit(ModelsUser $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsUser $user)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'nama' => 'required|string|max:255',
            'nis' => 'nullable|string|max:20',
            'kelas' => 'nullable|string|max:50',
            'nip' => 'nullable|string|max:20',
        ]);

        $user->update([
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        // Update related model based on role
        switch ($request->role) {
            case 'siswa':
                $user->student()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama' => $request->nama,
                        'nis' => $request->nis,
                        'kelas' => $request->kelas,
                    ]
                );
                break;
            case 'guru':
                $user->teacher()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama' => $request->nama,
                        'nip' => $request->nip,
                    ]
                );
                break;
            case 'admin':
                $user->admin()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nama' => $request->nama,
                    ]
                );
                break;
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsUser $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    
}
