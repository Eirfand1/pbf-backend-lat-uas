<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class Dosen extends ResourceController
{
	protected $modelName = 'App\Models\DosenModel';
	protected $format    = 'json';
	/**
	 * Return an array of resource objects, themselves in array format.
	 *
	 * @return ResponseInterface
	 */
	public function index()
	{
		$data = $this->model->findAll();
		return $this->respond($data);
	}

	/**
	 * Return the properties of a resource object.
	 *
	 * @param int|string|null $id
	 *
	 * @return ResponseInterface
	 */
	public function show($id = null)
	{
		$data = $this->model->find($id);
		if ($data) {
			return $this->respond($data);
		}
		return $this->failNotFound('Dosen tidak ditemukan');
	}

	/**
	 * Return a new resource object, with default properties.
	 *
	 * @return ResponseInterface
	 */
	public function new()
	{
		//
	}

	/**
	 * Create a new resource object, from "posted" parameters.
	 *
	 * @return ResponseInterface
	 */
	public function create()
	{
		$input = $this->request->getJSON(true);
		$this->model->insert($input);
		return $this->respondCreated($input);
	}

	/**
	 * Return the editable properties of a resource object.
	 *
	 * @param int|string|null $id
	 *
	 * @return ResponseInterface
	 */
	public function edit($id = null)
	{
		//
	}

	/**
	 * Add or update a model resource, from "posted" properties.
	 *
	 * @param int|string|null $id
	 *
	 * @return ResponseInterface
	 */
	public function update($id = null)
	{
		$input = $this->request->getJSON(true);
		$this->model->update($id, $input);
		return $this->respond(['status' => 'updated']);
	}

	/**
	 * Delete the designated resource object from the model.
	 *
	 * @param int|string|null $id
	 *
	 * @return ResponseInterface
	 */
	public function delete($id = null)
	{
		$this->model->delete($id);
		return $this->respondDeleted(['status' => 'deleted']);
	}
}
