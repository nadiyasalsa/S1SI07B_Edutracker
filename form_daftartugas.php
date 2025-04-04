<?php 
include 'navbar.php';
include 'config.php';
$result = mysqli_query($conn, "SELECT * FROM daftartugas ORDER BY deadline ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
            <h2 class="text-center mb-4">📋 Daftar Tugas</h2>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Deskripsi</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['mata_kuliah']) ?></td>
                                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                    <td><?= date('d M Y', strtotime($row['deadline'])) ?></td>
                                    <td>
                                        <span class="badge <?= $row['status'] == 'Selesai' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $row['status'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="form_edittugas.php?id=<?= $row['id_tugas'] ?>" 
                                           class="btn btn-sm btn-primary"
                                           title="Edit Tugas">
                                           <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="delete.php?id=<?= $row['id_tugas'] ?>" 
                                           class="btn btn-sm btn-danger"
                                           title="Hapus Tugas"
                                           onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                                           <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Belum ada tugas yang tercatat
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>