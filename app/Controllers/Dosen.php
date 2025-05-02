<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Dosen extends ResourceController
{
    protected $modelName = 'App\Models\Dosen';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Dosen tidak ditemukan');
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
