<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Mahasiswa extends ResourceController
{
    protected $modelName = 'App\Models\Mahasiswa';
    protected $format    = 'json';

    public function index()
    {
        // Join tabel dosen untuk ambil nama dosen wali
        $data = $this->model
            ->select('mahasiswa.*, dosen.nama as dosen_wali')
            ->join('dosen', 'dosen.id = mahasiswa.dosen_wali_id')
            ->findAll();

        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model
            ->select('mahasiswa.*, dosen.nama as dosen_wali')
            ->join('dosen', 'dosen.id = mahasiswa.dosen_wali_id')
            ->where('mahasiswa.id', $id)
            ->first();

        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Mahasiswa tidak ditemukan');
    }

    public function create()
    {
        $input = $this->request->getJSON(true);
        $this->model->insert($input);
        return $this->respondCreated($input);
    }

    public function update($id = null)
    {
        $input = $this->request->getJSON(true);
        $this->model->update($id, $input);
        return $this->respond(['status' => 'updated']);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respondDeleted(['status' => 'deleted']);
    }
}
