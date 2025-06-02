<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: buat_admin.php");
    exit();
}

// Ambil semua data mahasiswa dan jumlah tugas mereka
$query = "
    SELECT m.id, m.nama, m.nim, m.email, COUNT(t.id) AS jumlah_tugas
    FROM mahasiswa m
    LEFT JOIN tugas t ON m.id = t.mahasiswa_id
    GROUP BY m.id, m.nama, m.nim, m.email
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$mahasiswa = [];
while ($row = mysqli_fetch_assoc($result)) {
    $mahasiswa[] = [
        'id' => $row['id'],
        'nama' => $row['nama'],
        'nim' => $row['nim'] ?? 'N/A',
        'email' => $row['email'] ?? 'N/A',
        'jumlah_tugas' => $row['jumlah_tugas']
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #8360c3, #2ebf91);
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #444;
        }
        .logout {
            text-align: right;
            margin-bottom: 20px;
        }
        .logout button {
            background: #ff4d4d;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
        .logout button:hover {
            background: #d93636;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2ebf91;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f6f6f6;
        }
        tr:hover {
            background-color: #dffaf1;
        }
        a.nama-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a.nama-link:hover {
            text-decoration: underline;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
        }
        .modal {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .modal h3 {
            margin-bottom: 20px;
            color: #333;
        }
        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-yes {
            background-color: #ff4d4d;
            color: white;
        }
        .btn-no {
            background-color: #ccc;
        }
        .btn-yes:hover {
            background-color: #d93636;
        }
        .btn-no:hover {
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="logout">
            <button onclick="showModal()">Logout</button>
        </div>

        <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>

        <h2>Detail Mahasiswa</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Jumlah Tugas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($mahasiswa as $mhs): ?>
                <tr>
                    <td>
                        <a class="nama-link" href="lihat_tugas_mahasiswa.php?id=<?= $mhs['id'] ?>">
                            <?= htmlspecialchars($mhs['nama']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($mhs['nim']) ?></td>
                    <td><?= htmlspecialchars($mhs['email']) ?></td>
                    <td><?= $mhs['jumlah_tugas'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <h3>Yakin ingin keluar?</h3>
            <div class="modal-buttons">
                <button class="btn-yes" onclick="logout()">Ya</button>
                <button class="btn-no" onclick="hideModal()">Tidak</button>
            </div>
        </div>
    </div>

    <script>
        function showModal() {
            document.getElementById('modalOverlay').style.display = 'flex';
        }

        function hideModal() {
            document.getElementById('modalOverlay').style.display = 'none';
        }

        function logout() {
            window.location.href = "logout.php";
        }
    </script>
</body>
</html>
