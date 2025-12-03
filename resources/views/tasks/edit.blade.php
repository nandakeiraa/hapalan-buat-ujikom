<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>

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

        .back {
            text-decoration: none;
            color: #ffd6ff;
            font-size: 18px;
        }
    </style>

</head>
<body>

<div class="container">

    <h2>Edit Tugas</h2>

    <a href="{{ route('tasks.index') }}" class="back">← Kembali</a>
    <br><br>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-wrap">
            <input type="text" 
                   name="nama" 
                   value="{{ $task->nama }}" 
                   placeholder="Nama tugas" 
                   required>

            <input type="text" 
                   name="prioritas" 
                   value="{{ $task->prioritas }}" 
                   placeholder="Prioritas">

            <input type="date" 
                   name="tanggal" 
                   value="{{ $task->tanggal }}">
        </div>

        <button type="submit">Update</button>
    </form>

</div>

</body>
</html>
