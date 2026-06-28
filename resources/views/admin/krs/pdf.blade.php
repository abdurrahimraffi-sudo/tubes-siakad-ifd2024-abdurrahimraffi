<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data KRS - SIAKAD</title>
    <style>
        * { font-family: Arial, sans-serif; }
        body { margin: 20px; color: #1E293B; }
        .header { text-align: center; border-bottom: 3px solid #2563EB; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #2563EB; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2563EB; color: white; padding: 8px; text-align: left; font-size: 11px; }
        td { padding: 6px 8px; border-bottom: 1px solid #E2E8F0; font-size: 11px; }
        tr:nth-child(even) { background: #F8FAFC; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SIAKAD - Sistem Informasi Akademik</h2>
        <p>Laporan Data Kartu Rencana Studi (KRS) Seluruh Mahasiswa</p>
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Dosen</th>
                <th>Hari</th>
                <th>Tanggal Ambil</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($krs as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                <td>{{ $item->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                <td>{{ $item->jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                <td>{{ $item->jadwal->mataKuliah->sks ?? '-' }}</td>
                <td>{{ $item->jadwal->dosen->nama_dosen ?? '-' }}</td>
                <td>{{ $item->jadwal->hari ?? '-' }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}<br>
        Tanggal: {{ now()->format('d F Y') }}</p>
    </div>
</body>
</html>
