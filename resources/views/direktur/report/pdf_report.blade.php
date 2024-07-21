<!DOCTYPE html>
<html>

<head>
    <title>Pinjaman Report</title>
    <style>
        /* Add custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Pinjaman Report</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Jangka Waktu</th>
                <th>Nama Kelompok</th>
                <th>Jenis Kelompok</th>
                <th>Angsuran Ke</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row->row_number }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->nominal }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->jangka_waktu }}</td>
                    <td>{{ $row->nama_kelompok }}</td>
                    <td>{{ $row->jenis_kelompok }}</td>
                    <td>{{ $row->angsuran_ke }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
