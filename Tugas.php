<?php
// app/Controllers/Tugas.php
namespace App\Controllers;
use App\Models\TugasModel;
use CodeIgniter\Controller;

class Tugas extends Controller {
    public function index() {
        $model = new TugasModel();
        $data['tugas'] = $model->where('user_id', session()->get('user_id'))->findAll();
        return view('tugas/index', $data);
    }

    public function tambah() {
        if ($this->request->getMethod() === 'post') {
            $model = new TugasModel();
            $model->save([
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
                'user_id' => session()->get('user_id'),
            ]);
            return redirect()->to('/tugas');
        }
        return view('tugas/tambah');
    }

    public function edit($id) {
        $model = new TugasModel();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'deadline' => $this->request->getPost('deadline'),
                'status' => $this->request->getPost('status'),
            ]);
            return redirect()->to('/tugas');
        }
        $data['tugas'] = $model->find($id);
        return view('tugas/edit', $data);
    }

    public function hapus($id) {
        $model = new TugasModel();
        $model->delete($id);
        return redirect()->to('/tugas');
    }
}
