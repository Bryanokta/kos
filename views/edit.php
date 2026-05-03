<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Penghuni</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        h1 {
            color: #111827;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label.form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
            color: #1f2937;
            background-color: #f9fafb;
            outline: none;
            transition: all 0.2s;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #3b82f6;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: block;
            text-align: center;
            box-sizing: border-box;
        }

        .btn-success {
            background-color: #3b82f6;
            color: white;
            margin-bottom: 12px;
        }

        .btn-success:hover {
            background-color: #2563eb;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .current-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 12px;
            border: 1px dashed #d1d5db;
        }

        .img-preview {
            border-radius: 50%;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            margin-bottom: 10px;
        }

        .seat-selection {
            display: grid;
            grid-template-columns: 20px 45px 45px 20px 45px 45px;
            gap: 12px;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .seat-label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            text-align: center;
        }

        .seat-wrapper {
            position: relative;
        }

        .seat-wrapper input[type="radio"] {
            display: none;
        }

        .seat-box {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        .seat-available {
            border: 1px solid #93c5fd;
            background-color: #f8fafc;
        }

        .seat-half {
            background-color: #f472b6;
        }

        .seat-full {
            background-color: #9ca3af;
            cursor: not-allowed;
        }

        .seat-wrapper input[type="radio"]:checked+.seat-box {
            border: 3px solid #111827;
        }

        .seat-wrapper input[type="radio"]:disabled+.seat-box {
            opacity: 0.5;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
            font-size: 12px;
            color: #4b5563;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-box {
            width: 14px;
            height: 14px;
            border-radius: 3px;
        }

        .legend-available {
            border: 1px solid #93c5fd;
            background-color: #f8fafc;
        }

        .legend-half {
            background-color: #f472b6;
        }

        .legend-full {
            background-color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="form-card">
        <h1>Edit Penghuni</h1>
        <form action="index.php?action=edit&id=<?= $data['id'] ?>" method="POST" enctype="multipart/form-data">
            <div class="current-profile">
                <img src="uploads/<?= $data['foto'] ?>" width="80" height="80" class="img-preview" alt="">
                <span style="font-size: 13px; color: #6b7280; font-weight: 600;">Foto Saat Ini</span>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tipe Sewa</label>
                <select name="tipe_sewa" id="tipe_sewa" onchange="toggleSeats()" required>
                    <option value="Sharing" <?= $data['tipe_sewa'] == 'Sharing' ? 'selected' : '' ?>>Sharing (Maks 2 Orang)</option>
                    <option value="Private" <?= $data['tipe_sewa'] == 'Private' ? 'selected' : '' ?>>Private (1 Kamar Penuh)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Pilih Kamar</label>
                <div class="seat-selection">
                    <div></div>
                    <div class="seat-label">A</div>
                    <div class="seat-label">B</div>
                    <div></div>
                    <div class="seat-label">C</div>
                    <div class="seat-label">D</div>
                    <?php foreach ([1, 2, 3, 4] as $row): ?>
                        <div class="seat-label"><?= $row ?></div>
                        <?php foreach (['A', 'B', 'C', 'D'] as $col): ?>
                            <?php
                            if ($col == 'C') echo '<div></div>';
                            $kamar_id = $col . $row;
                            $occupancy = isset($roomCounts[$kamar_id]) ? $roomCounts[$kamar_id] : ['count' => 0, 'is_private' => 0];

                            if ($data['kamar'] === $kamar_id) {
                                $occupancy['count'] -= 1;
                                if ($data['tipe_sewa'] === 'Private') $occupancy['is_private'] = 0;
                            }

                            $status_class = 'seat-available';
                            $disabled = '';
                            $input_class = '';
                            $checked = ($data['kamar'] === $kamar_id) ? 'checked' : '';

                            if ($occupancy['is_private'] == 1 || $occupancy['count'] >= 2) {
                                $status_class = 'seat-full';
                                $disabled = 'disabled';
                            } elseif ($occupancy['count'] == 1) {
                                $status_class = 'seat-half';
                                $input_class = 'seat-half-input';
                            }
                            ?>
                            <label class="seat-wrapper">
                                <input type="radio" name="kamar" value="<?= $kamar_id ?>" class="<?= $input_class ?>" required <?= $disabled ?> <?= $checked ?>>
                                <div class="seat-box <?= $status_class ?>"></div>
                            </label>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <div class="seat-legend">
                    <div class="legend-item">
                        <div class="legend-box legend-available"></div> Tersedia
                    </div>
                    <div class="legend-item">
                        <div class="legend-box legend-half"></div> 1 Orang
                    </div>
                    <div class="legend-item">
                        <div class="legend-box legend-full"></div> Penuh
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn-success btn">Simpan Perubahan</button>
            <a href="index.php" class="btn-secondary btn">Batal</a>
        </form>
    </div>
    <script>
        function toggleSeats() {
            const isPrivate = document.getElementById('tipe_sewa').value === 'Private';
            const halfSeats = document.querySelectorAll('.seat-half-input');
            halfSeats.forEach(seat => {
                seat.disabled = isPrivate;
                if (isPrivate && seat.checked && !seat.defaultChecked) seat.checked = false;
            });
        }
        window.onload = toggleSeats;
    </script>
</body>

</html>