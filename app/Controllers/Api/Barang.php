<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BarangModel;

class Barang extends ResourceController
{
    protected $modelName = 'App\Models\BarangModel';
    protected $format    = 'json';

    // Menampilkan semua data barang (GET)
    public function index()
    {
        $data = $this->model->getBarangDenganKategori();

        return $this->respond([
            'status' => 200,
            'message' => 'Data berhasil diambil',
            'data' => $data
        ]);
    }

    // Menampilkan detail satu barang berdasarkan ID (GET)
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        }
        return $this->failNotFound('Barang tidak ditemukan');
    }
}
