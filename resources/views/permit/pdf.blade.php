<!DOCTYPE html>
<html>

<head>
    <title>Laporan Perizinan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .letterhead {
            margin-left: 50px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px;
            height: 100px;
        }

        hr {
            border: 1px solid;
        }

        .teks {
            margin-left: 5%;
        }

        .box {
            width: 100vh;
            margin-left: 10%;
            font-weight: 700;
        }

        span {
            font-weight: 300;
        }

        .box-conten {
            display: flex;
            align-items: center;
            border: 1px solid;
            justify-content: space-evenly;
            width: 50%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="letterhead">
        <img class="logo" src="{{ asset('assets/favicon.png')}}" alt="School Logo">
        <div class="teks">
            <h2>High School</h2>
            <p>Alamat: padang, singojuruh, banyuwangi</p>
            <p>Telepon: (0333) 11111111</p>
        </div>
    </div>
    <hr>
    <div class="box">
        <div class="box-conten">
            <p>Perihal </p>
            <p>:</p>
            <span>Laporan Izin</span>
        </div>
        <div class="box-conten">
            <p>Dibuat Pada </p>
            <p>:</p>
            <span>{{ date('d-m-Y') }}</span>
        </div>
    </div>
    <h1>Laporan Perizinan</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                @if ($permits->contains(function ($permit) { return $permit->user->role == 'siswa'; }))
                <th>Kelas</th>
                @endif
                <th>Tanggal Mulai</th>
                <th>Keterangan</th>
                <th>Image</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permits as $permit)
            <tr>
                <td>
                    @if ($permit->user->role == 'guru')
                    {{ $permit->user->teacher->nama }}
                    @elseif ($permit->user->role == 'siswa')
                    {{ $permit->user->student->nama }}
                    @else
                    -
                    @endif
                </td>
                @if ($permit->user->role == 'siswa')
                <td>
                    {{ $permit->user->student->kelas }}
                </td>
                @else

                @endif
                <td>{{ $permit->tanggal_mulai }}</td>
                <td>{{ $permit->keterangan }}</td>
                <td>
                    @if ($permit->img)
                    <img src="{{ public_path('storage/' . $permit->img) }}" width="100">
                    @else
                    -
                    @endif
                </td>
                <td>{{ $permit->user->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Laporan ini dihasilkan pada {{ date('d-m-Y') }}
    </div>
</body>

</html>