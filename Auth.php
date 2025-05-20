<?php

// app/Controllers/Auth.php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller {
    public function login() {
        helper(['form']);
        if ($this->request->getMethod() === 'post') {
            $model = new UserModel();
            $user = $model->where('username', $this->request->getPost('username'))->first();
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set(['user_id' => $user['id'], 'username' => $user['username']]);
                return redirect()->to('/tugas');
            }
            return redirect()->back()->with('error', 'Login gagal');
        }
        return view('auth/login');
    }

    public function register() {
        helper(['form']);
        if ($this->request->getMethod() === 'post') {
            $model = new UserModel();
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->insert($data);
            return redirect()->to('/login');
        }
        return view('auth/register');
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
}



// app/Models/UserModel.php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['username', 'password'];
    protected $useTimestamps = false;
}

// app/Models/TugasModel.php
namespace App\Models;
use CodeIgniter\Model;

class TugasModel extends Model {
    protected $table = 'tugas';
    protected $allowedFields = ['judul', 'deskripsi', 'deadline', 'status', 'user_id'];
    protected $useTimestamps = false;
}

// app/Config/Routes.php
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

$routes->get('/tugas', 'Tugas::index');
$routes->get('/tugas/tambah', 'Tugas::tambah');
$routes->post('/tugas/tambah', 'Tugas::tambah');
$routes->get('/tugas/edit/(:num)', 'Tugas::edit/$1');
$routes->post('/tugas/edit/(:num)', 'Tugas::edit/$1');
$routes->get('/tugas/hapus/(:num)', 'Tugas::hapus/$1');