@extends('layouts.app')

@section('content')
<div class="overflow-x-auto bg-white h-auto px-5 py-4 border rounded-lg shadow-lg">
    <h1 class="text-2xl mb-5 font-semibold text-gray-900 dark:text-white">Daftar Data Perizinan</h1>

    <!-- Create Permit Button -->
    <div class="mb-4 flex justify-between">
        <div>
            <a href="{{ route('permits.create') }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Buat Perizinan</a>
        </div>

        <!-- Filter Form -->
        <form id="filterForm" action="{{ route('permits.index') }}" method="GET" class="w-40 mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="role">Filter Data</label>
            <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
        </form>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        User Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Lengkap
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Mulai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gambar
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($permits as $permit)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $permit->id }}</td>
                    <td class="px-6 py-4">{{ $permit->user->email }}</td>
                    <td class="px-6 py-4">{{ $permit->user->role }}</td>
                    <td class="px-6 py-4">
                        @if($permit->user->role == 'siswa')
                        {{ $permit->user->student->nama ?? 'N/A' }}
                        @elseif($permit->user->role == 'guru')
                        {{ $permit->user->teacher->nama ?? 'N/A' }}
                        @elseif($permit->user->role == 'admin')
                        {{ $permit->user->admin->nama ?? 'N/A' }}
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $permit->tanggal_mulai }}</td>
                    <td class="px-6 py-4">{{ $permit->keterangan }}</td>
                    <td class="px-6 py-4">
                        @if($permit->status == 'Diproses')
                            <form action="{{ route('permits.updateStatus', $permit->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="diproses" {{ $permit->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="disetujui" {{ $permit->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $permit->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>
                        @else
                            {{ $permit->status }}
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($permit->img)
                        <img src="{{ asset('storage/' . $permit->img) }}" alt="Gambar" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        N/A
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('permits.destroy', $permit->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>
@endsection