<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan semua tugas
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Tambah tugas
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Task::create([
            'nama' => $request->nama,
            'prioritas' => $request->prioritas,
            'tanggal' => $request->tanggal,
            'status' => false
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Edit tugas
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'nama' => $request->nama,
            'prioritas' => $request->prioritas,
            'tanggal' => $request->tanggal
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diedit!');
    }

    // Tandai selesai
    public function selesai($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => true]);

        return redirect()->back()->with('success', 'Tugas ditandai selesai!');
    }

    // Hapus tugas
    public function destroy($id)
    {
        Task::destroy($id);

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }
}