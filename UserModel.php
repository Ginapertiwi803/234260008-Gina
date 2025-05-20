<?php
// Mendefinisikan namespace untuk model ini
namespace App\Models;

// Mengimpor kelas Model dari CodeIgniter
use CodeIgniter\Model;

// Mendefinisikan kelas UserModel yang merupakan turunan dari Model
class UserModel extends Model {
    // Menentukan nama tabel yang akan digunakan dalam model ini
    protected $table = 'users';
    
    // Menentukan kolom-kolom yang diizinkan untuk diisi (insert/update) dalam tabel
    protected $allowedFields = ['username', 'password'];
    
    // Menentukan apakah model ini menggunakan timestamp (created_at, updated_at)
    protected $useTimestamps = false; // Jika true, CodeIgniter secara otomatis mengisi kolom timestamp
}
