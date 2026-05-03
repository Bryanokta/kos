<?php
require_once 'model/database.php';

class Penghuni extends Database
{
    public function getAll()
    {
        $result = $this->conn->query("SELECT * FROM penghuni");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM penghuni WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insert($nama, $kamar, $tipe_sewa, $foto)
    {
        $stmt = $this->conn->prepare("INSERT INTO penghuni (nama, kamar, tipe_sewa, foto) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $kamar, $tipe_sewa, $foto);
        return $stmt->execute();
    }

    public function update($id, $nama, $kamar, $tipe_sewa, $foto)
    {
        if ($foto) {
            $stmt = $this->conn->prepare("UPDATE penghuni SET nama = ?, kamar = ?, tipe_sewa = ?, foto = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $nama, $kamar, $tipe_sewa, $foto, $id);
        } else {
            $stmt = $this->conn->prepare("UPDATE penghuni SET nama = ?, kamar = ?, tipe_sewa = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nama, $kamar, $tipe_sewa, $id);
        }
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM penghuni WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getRoomCounts()
    {
        $result = $this->conn->query("SELECT kamar, COUNT(*) as count, MAX(CASE WHEN tipe_sewa = 'Private' THEN 1 ELSE 0 END) as is_private FROM penghuni GROUP BY kamar");
        $counts = [];
        while ($row = $result->fetch_assoc()) {
            $counts[$row['kamar']] = [
                'count' => (int)$row['count'],
                'is_private' => (int)$row['is_private']
            ];
        }
        return $counts;
    }
}
