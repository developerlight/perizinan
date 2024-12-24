@extends('layouts.app')

@section('content')
<div class="overflow-x-auto bg-white h-auto px-5 py-4 border rounded-lg shadow-lg">
    <h1 class="text-2xl mb-5 font-semibold text-gray-900 dark:text-white">Daftar Data Siswa</h1>
    <div class="mb-5">
        <a href="{{ route('siswa.create') }}" class=" text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah Siswa</a>
    </div>
    <div class="table-responsive">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NIS
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Lengkap
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $student->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $student->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student->student->nis ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student->student->nama ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student->role }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('siswa.edit', $student->student->id) }}" class="font-medium text-blue-600 dark:text-blue-500 mr-2 hover:underline">Edit</a>
                            <form action="{{ route('siswa.destroy', $student->student->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection