<?php
require_once 'model/penghuni.php';

class PenghuniController
{
    private $model;

    public function __construct()
    {
        $this->model = new Penghuni();
    }

    public function index()
    {
        $data = $this->model->getAll();

        $total_kamar = 16;
        $total_penghuni = count($data);

        $kamar_array = array_column($data, 'kamar');
        $kamar_unik = array_unique($kamar_array);
        $kamar_terisi = count($kamar_unik);

        require 'views/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $kamar = $_POST['kamar'];
            $tipe_sewa = $_POST['tipe_sewa'];

            $roomCounts = $this->model->getRoomCounts();
            $roomData = isset($roomCounts[$kamar]) ? $roomCounts[$kamar] : ['count' => 0, 'is_private' => 0];

            $can_book = false;
            if ($roomData['count'] == 0) {
                $can_book = true;
            } elseif ($roomData['count'] == 1 && $roomData['is_private'] == 0 && $tipe_sewa == 'Sharing') {
                $can_book = true;
            }

            if ($can_book) {
                $foto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];

                move_uploaded_file($tmp, "uploads/" . $foto);
                $this->model->insert($nama, $kamar, $tipe_sewa, $foto);
            }

            header("Location: index.php");
        } else {
            $roomCounts = $this->model->getRoomCounts();
            require 'views/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $kamar = $_POST['kamar'];
            $tipe_sewa = $_POST['tipe_sewa'];

            $currentUser = $this->model->getById($id);
            $roomCounts = $this->model->getRoomCounts();
            $roomData = isset($roomCounts[$kamar]) ? $roomCounts[$kamar] : ['count' => 0, 'is_private' => 0];

            if ($kamar === $currentUser['kamar']) {
                $roomData['count'] -= 1;
                if ($currentUser['tipe_sewa'] === 'Private') {
                    $roomData['is_private'] = 0;
                }
            }

            $can_book = false;
            if ($roomData['count'] == 0) {
                $can_book = true;
            } elseif ($roomData['count'] == 1 && $roomData['is_private'] == 0 && $tipe_sewa == 'Sharing') {
                $can_book = true;
            }

            if ($can_book) {
                $foto = $_FILES['foto']['name'];

                if ($foto) {
                    $tmp = $_FILES['foto']['tmp_name'];
                    move_uploaded_file($tmp, "uploads/" . $foto);
                }

                $this->model->update($id, $nama, $kamar, $tipe_sewa, $foto);
            }

            header("Location: index.php");
        } else {
            $data = $this->model->getById($id);
            $roomCounts = $this->model->getRoomCounts();
            require 'views/edit.php';
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: index.php");
    }
}
