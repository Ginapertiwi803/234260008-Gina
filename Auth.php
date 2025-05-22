<?php
// app/Controllers/Auth.php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller {
    // Fungsi untuk menangani proses login
    public function login() {
        helper(['form']); // Memuat helper form untuk validasi dan pengolahan form
        if ($this->request->getMethod() === 'post') { // Memeriksa apakah metode request adalah POST
            $model = new UserModel(); // Membuat instance dari UserModel
            // Mencari pengguna berdasarkan username
            $user = $model->where('username', $this->request->getPost('username'))->first();
            // Memverifikasi password
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Menyimpan data pengguna ke dalam session
                session()->set(['user_id' => $user['id'], 'username' => $user['username']]);
                return redirect()->to('/tugas'); // Mengalihkan ke halaman tugas setelah login berhasil
            }
            return redirect()->back()->with('error', 'Login gagal'); // Mengalihkan kembali dengan pesan error jika login gagal
        }
        return view('auth/login'); // Menampilkan halaman login jika bukan POST
    }

    // Fungsi untuk menangani proses registrasi
    public function register() {
        helper(['form']); // Memuat helper form
        if ($this->request->getMethod() === 'post') { // Memeriksa apakah metode request adalah POST
            $model = new UserModel(); // Membuat instance dari UserModel
            // Menyiapkan data untuk disimpan
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Menghash password
            ];
            $model->insert($data); // Menyimpan data pengguna baru ke database
            return redirect()->to('/login'); // Mengalihkan ke halaman login setelah registrasi berhasil
        }
        return view('auth/register'); // Menampilkan halaman registrasi jika bukan POST
    }

    // Fungsi untuk menangani proses logout
    public function logout() {
        session()->destroy(); // Menghancurkan session pengguna
        return redirect()->to('/login'); // Mengalihkan ke halaman login setelah logout
    }
}
