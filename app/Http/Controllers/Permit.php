<?php

namespace App\Http\Controllers;

use App\Models\Permit as ModelsPermit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Permit extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ModelsPermit::with(['user', 'user.student', 'user.teacher', 'user.admin']);

        if ($request->has('role') && $request->role != '') {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        $permits = $query->get();
        // dd($permits);
        return view('permit.index', compact('permits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('permit.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_mulai' => 'required|date',
            'keterangan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // dd($request->all());

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        ModelsPermit::create([
            'user_id' => $request->user_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'keterangan' => $request->keterangan,
            'img' => $imagePath,
        ]);

        return redirect()->route('permit.index')->with('success', 'Permit created successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $permit = ModelsPermit::findOrFail($id);

        if ($permit->img) {
            Storage::disk('public')->delete($permit->img);
        }

        $permit->delete();
        return to_route('permits.index')->with('success', 'Permit deleted successfully.');
    }

    public function report(Request $request)
    {
        $query = ModelsPermit::query();

        if ($request->has('month') && $request->has('year')) {
            $query->whereMonth('tanggal_mulai', $request->month)
                ->whereYear('tanggal_mulai', $request->year);
        }

        if ($request->has('role')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        $permits = $query->get();

        return view('permit.report', compact('permits'));
    }

    public function updateStatus(Request $request, ModelsPermit $permit)
    {
        $request->validate([
            'status' => 'required|string|in:disetujui,ditolak',
        ]);

        $permit->status = $request->status;
        $permit->save();

        return redirect()->route('permits.index')->with('success', 'Status permit berhasil diperbarui.');
    }
}
