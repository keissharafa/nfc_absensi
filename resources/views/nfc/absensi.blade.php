<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Absensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --purple-primary: #7c3aed;
            --purple-dark: #5b21b6;
            --purple-light: #ede9fe;
            --purple-accent: #8b5cf6;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-400: #9ca3af;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #e9e0ff;
            min-height: 100vh;
        }

        /* PAGE HEADER */
        h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 4px;
        }

        /* BACK LINK */
        a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: var(--white);
            border: 1.5px solid var(--purple-primary);
            color: var(--purple-primary);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all .2s;
        }

        a:hover {
            background: var(--purple-light);
            transform: translateY(-1px);
        }

        /* TABLE WRAPPER */
        .table-wrapper {
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: none !important;
        }

        /* HEADER ROW */
        table tr:first-child th {
            background: var(--gray-50);
            color: var(--gray-600);
            font-size: 11.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            padding: 13px 18px;
            text-align: left;
            border-bottom: 1.5px solid var(--gray-200);
            border-right: none;
            border-left: none;
            border-top: none;
            white-space: nowrap;
        }

        /* DATA ROWS */
        table tr td {
            padding: 13px 18px;
            font-size: 13.5px;
            color: var(--gray-800);
            border-bottom: 1px solid var(--gray-100);
            border-right: none;
            border-left: none;
            border-top: none;
            vertical-align: middle;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        table tr:hover td {
            background: var(--gray-50);
        }

        /* STATUS BADGE */
        td:last-child {
            font-weight: 600;
            font-size: 12.5px;
        }

        /* LAYOUT WRAPPER */
        .layout {
            padding: 32px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-breadcrumb {
            font-size: 12px;
            color: var(--gray-400);
            margin-top: 2px;
            margin-bottom: 20px;
        }

        .page-breadcrumb span { color: var(--gray-600); }

        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .layout { padding: 16px; }
            table { min-width: 600px; }
            .table-wrapper { overflow-x: auto; }
        }
    </style>
</head>
<body>

<div class="layout">

    <div class="page-header">
        <h2>Data Absensi NFC</h2>
        <div class="page-breadcrumb">Home / <span>Attendance</span> / <span>Data Absensi</span></div>
    </div>

    <div class="header-row">
        <a href="/"><i data-lucide="arrow-left" style="width:15px;height:15px"></i> Kembali ke Scanner</a>
    </div>

    <br><br>

    <div class="table-wrapper">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Status</th>
            </tr>

            @foreach($absensi as $index => $a)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $a->mahasiswa->nim }}</td>
                <td>{{ $a->mahasiswa->nama }}</td>
                <td>{{ $a->mahasiswa->kelas }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->jam_masuk }}</td>
                <td>{{ $a->status }}</td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

<script>lucide.createIcons();</script>

</body>
</html>