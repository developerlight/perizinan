@extends('layouts.app')

@section('content')
<div class="overflow-x-auto bg-white h-auto px-5 py-4 border rounded-lg">
    <h1 class="text-2xl mb-5 font-semibold text-gray-900 dark:text-white">Cetak Laporan Perizinan</h1>

    <form id="filterForm" action="{{ route('cetak.index') }}" method="GET" class="border px-4 py-2 rounded-lg shadow-lg">
        <div class="grid md:grid-cols-3 md:gap-6">
            <div class="form-group">
                <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bulan:</label>
                <input type="number" name="month" id="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan angka bulan" min="1" max="12">
            </div>
            <div class="form-group">
                <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun:</label>
                <input type="number" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan angka tahun" min="2000" max="{{ date('Y') }}">
            </div>
            <div class="form-group">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role:</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Pilih Role</option>
                    @foreach(['siswa' => 'Siswa', 'guru' => 'Guru'] as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Filter</button>
            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" id="resetButton">Reset</button>
            <a href="{{ route(name: 'cetak.pdf', parameters: request()->query()) }}" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"> Cetak PDF</a>
        </div>
        <!-- <a href="{{ route('cetak.pdf', request()->query()) }}" class="btn btn-success">Cetak PDF</a> -->
    </form>
    <div class="relative overflow-x-auto shadow-md mt-5 sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Mulai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Keterangan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($permits as $permit)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ getUserName($permit->user) }}</td>
                    <td class="px-6 py-4">{{ getUserClass($permit->user) }}</td>
                    <td class="px-6 py-4">{{ $permit->tanggal_mulai }}</td>
                    <td class="px-6 py-4">{{ $permit->keterangan }}</td>
                    <td class="px-6 py-4"><img src="{{ asset('storage/' . $permit->img) }}" alt="Permit Image" style="width: 100px; height: 100px; object-fit: cover;"></td>
                    <td class="px-6 py-4 font-semibold">{{ $permit->user->role }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        window.location.href = "{{ route('cetak.index') }}";
    });
</script>
@endsection

@php
function getUserName($user) {
if ($user->role == 'guru') {
return $user->teacher->nama;
} elseif ($user->role == 'siswa') {
return $user->student->nama;
}
return '-';
}

function getUserClass($user) {
if ($user->role == 'siswa') {
return $user->student->kelas;
}
return '-';
}
@endphp