<?php
// Mendefinisikan namespace untuk model ini
namespace App\Models;

// Mengimpor kelas Model dari CodeIgniter
use CodeIgniter\Model;

// Mendefinisikan kelas TugasModel yang merupakan turunan dari Model
class TugasModel extends Model {
    // Menentukan nama tabel yang akan digunakan dalam model ini
    protected $table = 'tugas';
    
    // Menentukan kolom-kolom yang diizinkan untuk diisi (insert/update) dalam tabel
    protected $allowedFields = ['judul', 'deskripsi', 'deadline', 'status', 'user_id'];
    
    // Menentukan apakah model ini menggunakan timestamp (created_at, updated_at)
    protected $useTimestamps = false; // Jika true, CodeIgniter akan otomatis mengisi kolom timestamp
}
