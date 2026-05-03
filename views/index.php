<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Kos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 30px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-top: 4px solid transparent;
        }

        .card-total {
            border-top-color: #3b82f6;
        }

        .card-terisi {
            border-top-color: #f59e0b;
        }

        .card-penghuni {
            border-top-color: #8b5cf6;
        }

        .card h3 {
            margin: 0 0 8px 0;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
        }

        .card p {
            margin: 0;
            font-size: 36px;
            font-weight: 700;
            color: #111827;
        }

        .table-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 9999px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-warning {
            background-color: #fef3c7;
            color: #d97706;
            padding: 6px 16px;
        }

        .btn-warning:hover {
            background-color: #fde68a;
        }

        .btn-danger {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 6px 16px;
        }

        .btn-danger:hover {
            background-color: #fecaca;
        }

        .action-group {
            display: flex;
            gap: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f9fafb;
            color: #4b5563;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
        }

        tr:hover td {
            background-color: #f9fafb;
        }

        .profile-wrapper {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .profile-img {
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge {
            background: #e0e7ff;
            color: #4f46e5;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-private {
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 8px;
        }

        .badge-sharing {
            background: #d1fae5;
            color: #059669;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 700;
            margin-left: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="header-title">Manajemen Kos</h1>
        <div class="dashboard-grid">
            <div class="card card-total">
                <h3>Total Kamar</h3>
                <p><?= $total_kamar ?></p>
            </div>
            <div class="card card-terisi">
                <h3>Kamar Terisi</h3>
                <p><?= $kamar_terisi ?></p>
            </div>
            <div class="card card-penghuni">
                <h3>Total Penghuni</h3>
                <p><?= $total_penghuni ?></p>
            </div>
        </div>
        <div class="table-container">
            <div class="toolbar">
                <a href="index.php?action=create" class="btn btn-primary">+ Tambah Penghuni Baru</a>
            </div>
            <table>
                <tr>
                    <th>Penghuni</th>
                    <th>Nomor Kamar</th>
                    <th>Aksi</th>
                </tr>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td>
                            <div class="profile-wrapper">
                                <img src="uploads/<?= $row['foto'] ?>" alt="" width="50" height="50" class="profile-img">
                                <strong><?= htmlspecialchars($row['nama']) ?></strong>
                            </div>
                        </td>
                        <td>
                            <span class="badge"><?= htmlspecialchars($row['kamar']) ?></span>
                            <?php if ($row['tipe_sewa'] == 'Private'): ?>
                                <span class="badge-private">Private</span>
                            <?php else: ?>
                                <span class="badge-sharing">Sharing</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>