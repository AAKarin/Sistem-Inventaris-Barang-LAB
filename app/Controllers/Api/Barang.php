<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BarangModel;

class Barang extends ResourceController
{
    protected $modelName = 'App\Models\BarangModel';
    protected $format    = 'json';

    public function index()
    {
        $data = $this->model->getBarangDenganKategori();

        return $this->respond([
            'status' => 200,
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Barang tidak ditemukan');
    }

    public function create()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        if ($this->model->insert($data)) {
            return $this->respondCreated([
                'status' => 201,
                'message' => 'Data barang berhasil ditambahkan'
            ]);
        }

        return $this->fail('Gagal menambahkan data barang');
    }

    public function update($id = null)
    {
        $cekBarang = $this->model->find($id);
        if (!$cekBarang) {
            return $this->failNotFound('Barang tidak ditemukan untuk diupdate');
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();

        if ($this->model->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'message' => 'Data barang berhasil diupdate'
            ]);
        }

        return $this->fail('Gagal mengupdate data barang');
    }

    public function delete($id = null)
    {
        $cekBarang = $this->model->find($id);
        if (!$cekBarang) {
            return $this->failNotFound('Barang tidak ditemukan untuk dihapus');
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted([
                'status' => 200,
                'message' => 'Data barang berhasil dihapus'
            ]);
        }

        return $this->fail('Gagal menghapus data barang');
    }
}
