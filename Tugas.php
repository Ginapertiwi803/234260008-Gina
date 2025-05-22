<?php
// app/Controllers/Tugas.php
namespace App\Controllers;
use App\Models\TugasModel;
use CodeIgniter\Controller;

class Tugas extends Controller {
    // Fungsi untuk menampilkan daftar tugas
    public function index() {
        $model = new TugasModel(); // Membuat instance dari TugasModel
        // Mengambil semua tugas yang terkait dengan user_id dari session
        $data['tugas'] = $model->where('user_id', session()->get('user_id'))->findAll();
        return view('tugas/index', $data); // Mengembalikan view dengan data tugas
    }

    // Fungsi untuk menambah tugas baru
    public function tambah() {
        if ($this->request->getMethod() === 'post') { // Memeriksa apakah metode request adalah POST
            $model = new TugasModel(); // Membuat instance dari TugasModel
            // Menyimpan data tugas baru ke database
            $model->save([
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
                'user_id' => session()->get('user_id'), // Mengaitkan tugas dengan user yang sedang login
            ]);
            return redirect()->to('/tugas'); // Mengalihkan ke halaman daftar tugas setelah berhasil menambah
        }
        return view('tugas/tambah'); // Menampilkan form tambah tugas jika bukan POST
    }

    // Fungsi untuk mengedit tugas yang sudah ada
    public function edit($id) {
        $model = new TugasModel(); // Membuat instance dari TugasModel
        if ($this->request->getMethod() === 'post') { // Memeriksa apakah metode request adalah POST
            // Memperbarui data tugas berdasarkan ID
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
            ]);
            return redirect()->to('/tugas'); // Mengalihkan ke halaman daftar tugas setelah berhasil mengedit
        }
        // Mengambil data tugas berdasarkan ID untuk ditampilkan di form edit
        $data['tugas'] = $model->find($id);
        return view('tugas/edit', $data); // Menampilkan form edit tugas
    }

    // Fungsi untuk menghapus tugas berdasarkan ID
    public function hapus($id) {
        $model = new TugasModel(); // Membuat instance dari TugasModel
        $model->delete($id); // Menghapus tugas berdasarkan ID
        return redirect()->to('/tugas'); // Mengalihkan ke halaman daftar tugas setelah berhasil menghapus
    }
}
