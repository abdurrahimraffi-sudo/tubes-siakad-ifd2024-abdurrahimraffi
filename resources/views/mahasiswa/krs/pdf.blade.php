<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nim }}</title>
    <style>
        * { font-family: Arial, sans-serif; }
        body { margin: 30px; color: #1E293B; }
        .header { text-align: center; border-bottom: 3px solid #2563EB; padding-bottom: 15px; margin-bottom: 25px; }
        .header h2 { margin: 0; color: #2563EB; font-size: 22px; }
        .header p { margin: 3px 0 0; font-size: 12px; }
        .biodata { margin-bottom: 20px; }
        .biodata table { width: 100%; font-size: 12px; }
        .biodata td { padding: 3px 0; }
        .biodata td:first-child { width: 120px; font-weight: bold; }
        .section-title { background: #2563EB; color: white; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: bold; margin-bottom: 10px; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #DBEAFE; color: #1E40AF; padding: 8px; text-align: left; font-size: 11px; border: 1px solid #BFDBFE; }
        table.data td { padding: 6px 8px; border: 1px solid #E2E8F0; font-size: 11px; }
        table.data tfoot th { background: #1E40AF; color: white; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; font-size: 11px; }
        .signature { text-align: center; }
        .signature p { margin: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KARTU RENCANA STUDI (KRS)</h2>
        <p>Sistem Informasi Akademik - SIAKAD</p>
    </div>

    <div class="biodata">
        <table>
            <tr><td>NIM</td><td>: {{ $mahasiswa->nim }}</td><td>Semester</td><td>: {{ $mahasiswa->semester }}</td></tr>
            <tr><td>Nama</td><td>: {{ $mahasiswa->nama_mahasiswa }}</td><td>Tanggal</td><td>: {{ now()->format('d/m/Y') }}</td></tr>
            <tr><td>Email</td><td>: {{ $mahasiswa->email }}</td><td>No. HP</td><td>: {{ $mahasiswa->no_hp }}</td></tr>
        </table>
    </div>

    <div class="section-title">Daftar Mata Kuliah yang Diambil</div>
    <table class="data">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="50">SKS</th>
                <th>Dosen</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($krsList as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $k->jadwal->mataKuliah->kode_mk }}</td>
                <td>{{ $k->jadwal->mataKuliah->nama_mk }}</td>
                <td>{{ $k->jadwal->mataKuliah->sks }}</td>
                <td>{{ $k->jadwal->dosen->nama_dosen }}</td>
                <td>{{ $k->jadwal->hari }}</td>
                <td>{{ $k->jadwal->jam_mulai }} - {{ $k->jadwal->jam_selesai }}</td>
                <td>{{ $k->jadwal->ruangan }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right;">Total SKS:</th>
                <th>{{ $totalSks }}</th>
                <th colspan="4"></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div>
            <p>Mahasiswa,</p>
            <br><br><br>
            <p><strong>{{ $mahasiswa->nama_mahasiswa }}</strong></p>
        </div>
        <div class="signature">
            <p>Depok, {{ now()->format('d F Y') }}</p>
            <p>Ketua Program Studi,</p>
            <br><br><br>
            <p><strong>_______________________</strong></p>
        </div>
    </div>
</body>
</html>
