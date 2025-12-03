<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO-DO LIST</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #3c1053, #ad5389);
            color: #ffe6f2;
        }

        .container {
            width: 70%;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.08);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-wrap {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input, select {
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            border: none;
            outline: none;
            background: rgba(255,255,255,0.2);
            color: white;
        }

        input::placeholder {
            color: #ffd1ec;
        }

        button {
            padding: 12px 20px;
            background: linear-gradient(45deg, #ff416c, #ff9a00);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            width: 100px;
        }

        button:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.3);
            text-align: left;
        }

        th {
            background: rgba(255,255,255,0.15);
            font-size: 18px;
            color: #ffe6f2;
        }
    </style>

</head>
<body>

<div class="container">

    <h2>TO-DO LIST</h2>

    <!-- Form Tambah -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="form-wrap">
            <input type="text" name="nama" placeholder="Nama tugas" required>
            <input type="text" name="prioritas" placeholder="Prioritas">
            <input type="date" name="tanggal">
            <button type="submit">Tambah</button>
        </div>
    </form>

    <h3>Daftar Tugas:</h3>

    <table>
        <tr>
            <th>Nama</th>
            <th>Status</th>
            <th>Prioritas</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->nama }}</td>
                <td>{{ $task->status ? 'Selesai' : 'Belum' }}</td>
                <td>{{ $task->prioritas }}</td>
                <td>{{ $task->tanggal }}</td>

                    <!-- Contoh tombol aksi -->
                   <td style="text-align: center;">
    <div style="display: inline-flex; align-items: center; justify-content: center; gap: 12px;">
        
        <!-- Tombol Selesai -->
        <a href="{{ route('tasks.selesai', $task->id) }}"
           style="color: #00ffb7; text-decoration:none; font-size:30px;">
            ✔
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="margin:0;">
            @csrf
            @method('DELETE')
            <button style="background:none;border:none;color:#ff4d4d;cursor:pointer;font-size:30px;">
                🗑
            </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada tugas</td>
            </tr>
        @endforelse
    </table>
</div>
</body>
</html>
