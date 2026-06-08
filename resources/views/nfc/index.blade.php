<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi NFC</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            display: flex;
            flex-direction: column;
        }

        /* TOP NAV */
        .topnav {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 64px;
            background: var(--white);
            display: flex;
            align-items: center;
            padding: 0 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            z-index: 100;
            gap: 16px;
        }

        .topnav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 16px;
            color: var(--purple-primary);
        }

        .topnav-brand-icon {
            width: 32px; height: 32px;
            background: var(--purple-primary);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white;
        }

        .topnav-search {
            flex: 1;
            max-width: 360px;
            position: relative;
        }

        .topnav-search input {
            width: 100%;
            padding: 8px 16px 8px 40px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            color: var(--gray-600);
            background: var(--gray-50);
            outline: none;
            transition: border-color .2s;
        }

        .topnav-search input:focus { border-color: var(--purple-accent); }

        .topnav-search-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            display: flex; align-items: center;
        }

        .topnav-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topnav-icon-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: none;
            background: var(--gray-100);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--gray-600);
            transition: background .2s;
        }

        .topnav-icon-btn:hover { background: var(--purple-light); color: var(--purple-primary); }

        .topnav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 4px 10px;
            border-radius: 10px;
            transition: background .2s;
        }

        .topnav-user:hover { background: var(--gray-100); }

        .topnav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #a78bfa);
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .topnav-user-name { font-size: 13px; font-weight: 600; color: var(--gray-800); }
        .topnav-user-role { font-size: 11px; color: var(--gray-400); }

        /* LAYOUT */
        .layout {
            margin-top: 64px;
            padding: 32px;
        }

        /* PAGE HEADER */
        .page-header {
            margin-bottom: 24px;
        }

        .page-title { font-size: 20px; font-weight: 700; color: var(--gray-800); }
        .page-breadcrumb { font-size: 12px; color: var(--gray-400); margin-top: 2px; }
        .page-breadcrumb span { color: var(--gray-600); }

        /* CARD */
        .card {
            background: var(--white);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-icon {
            width: 30px; height: 30px;
            background: var(--purple-light);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--purple-primary);
            flex-shrink: 0;
        }

        /* FORM */
        select {
            width: 100%;
            max-width: 420px;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-family: inherit;
            font-size: 13.5px;
            color: var(--gray-800);
            background: var(--gray-50);
            outline: none;
            appearance: none;
            transition: border-color .2s, box-shadow .2s;
        }

        select:focus {
            border-color: var(--purple-accent);
            box-shadow: 0 0 0 3px rgba(124,58,237,.1);
            background: white;
        }

        .form-group { margin-bottom: 16px; }
        .form-label { display: block; font-size: 12.5px; font-weight: 600; color: var(--gray-600); margin-bottom: 6px; }

        /* BUTTONS */
        button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-primary { background: var(--purple-primary); color: white; }
        .btn-primary:hover {
            background: var(--purple-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(124,58,237,.35);
        }

        .btn-secondary { background: var(--purple-light); color: var(--purple-primary); }
        .btn-secondary:hover { background: #ddd6fe; transform: translateY(-1px); }

        /* STATUS */
        #status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--gray-50);
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-size: 13px;
            color: var(--gray-600);
            font-weight: 500;
            margin-bottom: 16px;
        }

        #hasil {
            background: var(--gray-50);
            border: 1.5px solid var(--gray-200);
            border-radius: 12px;
            overflow: hidden;
        }

        #hasil:empty { display: none; }

        #hasil p {
            padding: 11px 18px;
            font-size: 13.5px;
            color: var(--gray-800);
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            gap: 8px;
        }

        #hasil p:last-child { border-bottom: none; }
        #hasil p b { color: var(--gray-600); font-weight: 600; min-width: 130px; }

        /* LINK */
        a.view-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: var(--white);
            border: 1.5px solid var(--purple-primary);
            color: var(--purple-primary);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: all .2s;
            margin-top: 4px;
        }

        a.view-link:hover { background: var(--purple-light); transform: translateY(-1px); }

        /* GRID */
        .card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 768px) {
            .card-grid { grid-template-columns: 1fr; }
            .layout { padding: 16px; }
        }

        /* lucide */
        [data-lucide] { width: 16px; height: 16px; stroke-width: 2; }
        .icon-18 { width: 18px !important; height: 18px !important; }
    </style>
</head>
<body>

<!-- TOP NAV -->
<nav class="topnav">
    <div class="topnav-brand">
        <div class="topnav-brand-icon">
            <i data-lucide="graduation-cap" style="color:white"></i>
        </div>
        Universitas Airlangga
    </div>
    <div class="topnav-search">
        <span class="topnav-search-icon">
            <i data-lucide="search"></i>
        </span>
        <input type="text" placeholder="What do you want to find?">
    </div>
    <div class="topnav-right">
        <button class="topnav-icon-btn" title="Notifications">
            <i data-lucide="bell" class="icon-18"></i>
        </button>
        <button class="topnav-icon-btn" title="Messages">
            <i data-lucide="message-circle" class="icon-18"></i>
        </button>
        <div class="topnav-user">
            <div class="topnav-avatar">A</div>
            <div>
                <div class="topnav-user-name">Admin</div>
                <div class="topnav-user-role">Administrator</div>
            </div>
            <i data-lucide="chevron-down" style="color:var(--gray-400)"></i>
        </div>
    </div>
</nav>

<div class="layout">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="page-title">Sistem Absensi NFC</div>
        <div class="page-breadcrumb">Home / <span>Attendance</span> / <span>NFC</span></div>
    </div>

    <div class="card-grid">

        <!-- CARD: DAFTARKAN KARTU -->
        <div class="card">
            <div class="card-title">
                <div class="card-icon">
                    <i data-lucide="credit-card" class="icon-18"></i>
                </div>
                Daftarkan Kartu NFC
            </div>

            <div class="form-group">
                <label class="form-label" for="mahasiswa_id">Pilih Mahasiswa</label>
                <select id="mahasiswa_id">
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->id }}">
                            {{ $mhs->nim }} - {{ $mhs->nama }} - {{ $mhs->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn-primary" onclick="daftarKartu()">
                <i data-lucide="wifi"></i>
                Scan &amp; Daftarkan Kartu
            </button>
        </div>

        <!-- CARD: SCAN ABSENSI -->
        <div class="card">
            <div class="card-title">
                <div class="card-icon">
                    <i data-lucide="scan-line" class="icon-18"></i>
                </div>
                Scan Absensi
            </div>

            <p style="font-size:13.5px;color:var(--gray-600);margin-bottom:20px;line-height:1.6;">
                Tempelkan kartu NFC mahasiswa ke perangkat untuk mencatat kehadiran secara otomatis.
            </p>

            <button class="btn-secondary" onclick="scanAbsensi()">
                <i data-lucide="radio"></i>
                Aktifkan NFC untuk Absensi
            </button>
        </div>

    </div>

    <!-- STATUS & HASIL -->
    <div class="card">
        <div class="card-title">
            <div class="card-icon">
                <i data-lucide="bar-chart-2" class="icon-18"></i>
            </div>
            Status &amp; Hasil
        </div>

        <p id="status">
            <i data-lucide="circle-dashed"></i>
            NFC belum aktif.
        </p>
        <div id="hasil"></div>

        <br>
        <a class="view-link" href="/data-absensi">
            <i data-lucide="table-2"></i>
            Lihat Data Absensi
        </a>
    </div>

</div>

<script>
lucide.createIcons();

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function daftarKartu() {
    const mahasiswaId = document.getElementById('mahasiswa_id').value;

    if (!mahasiswaId) {
        alert('Pilih mahasiswa terlebih dahulu.');
        return;
    }

    if (!('NDEFReader' in window)) {
        document.getElementById('status').innerText = 'Browser tidak mendukung Web NFC.';
        return;
    }

    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        document.getElementById('status').innerText = 'NFC aktif. Tempelkan kartu untuk didaftarkan...';

        ndef.addEventListener('reading', async ({ serialNumber }) => {
            const response = await fetch('/daftar-kartu', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    mahasiswa_id: mahasiswaId,
                    serial_number: serialNumber
                })
            });

            const data = await response.json();

            document.getElementById('hasil').innerHTML = `
                <p><b>Status:</b> ${data.message}</p>
                <p><b>Serial Number:</b> ${serialNumber}</p>
            `;
        });

    } catch (error) {
        document.getElementById('status').innerText = 'Error: ' + error.message;
    }
}

async function scanAbsensi() {
    if (!('NDEFReader' in window)) {
        document.getElementById('status').innerText = 'Browser tidak mendukung Web NFC.';
        return;
    }

    try {
        const ndef = new NDEFReader();
        await ndef.scan();

        document.getElementById('status').innerText = 'NFC aktif. Tempelkan kartu mahasiswa...';

        ndef.addEventListener('reading', async ({ serialNumber }) => {
            const response = await fetch('/scan-absensi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    serial_number: serialNumber
                })
            });

            const data = await response.json();

            document.getElementById('hasil').innerHTML = `
                <p><b>Status:</b> ${data.message}</p>
                <p><b>Nama:</b> ${data.nama ?? '-'}</p>
                <p><b>NIM:</b> ${data.nim ?? '-'}</p>
                <p><b>Serial Number:</b> ${serialNumber}</p>
            `;
        });

    } catch (error) {
        document.getElementById('status').innerText = 'Error: ' + error.message;
    }
}
</script>

</body>
</html>