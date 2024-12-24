@extends('layouts.app')

@section('content')
<div class="overflow-x-auto bg-white h-auto px-5 py-4 border rounded-lg shadow-lg">
    <h1 class="text-2xl mb-5 font-normal text-gray-900 dark:text-white">Hallo <span class="font-semibold">{{$teacher->nama}}</span> </h1>
    <div class="mb-5">
        <a href="{{ route('teacher.create') }}" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Ajukan Izin</a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
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
                </tr>
            </thead>
            <tbody>
                @foreach($permits as $permit)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $permit->id }}</td>
                    <td class="px-6 py-4">{{ $permit->tanggal_mulai ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $permit->keterangan ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $permit->status ?? 'N/A' }}</td>
                    <td class="px-6 py-4">
                        @if($permit->img)
                        <img src="{{ asset('storage/' . $permit->img) }}" alt="Gambar" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection