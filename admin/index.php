<?php
session_start();
require_once '../service/database_example.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0) {
    header('Location: ../index.php');
    exit();
}

$query = "SELECT report.id_report, report.isi_laporan, report.tgl_report, akun.username FROM report JOIN akun ON report.akun_id = akun.id";
$result = mysqli_query($connection, $query);

$akun_query = "SELECT id, username FROM akun";
$akun_result = mysqli_query($connection, $akun_query);

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Report</title>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding-top: 20px;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        h1, h2 {
            color: #2575fc;
            font-weight: bold;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #e9ecef;
        }

        .btn-back {
            margin-top: 20px;
            background-color: #6a11cb;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #2575fc;
            transform: scale(1.05);
        }

        .btn-success {
            background-color: #2575fc;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #6a11cb;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Daftar Report -->
        <h1>Daftar Seluruh Report</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Isi Laporan</th>
                        <th scope="col">Tanggal Report</th>
                        <th scope="col">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<th scope="row">' . $no . '</th>';
                        echo '<td>' . $row['isi_laporan'] . '</td>';
                        echo '<td>' . $row['tgl_report'] . '</td>';
                        echo '<td>' . $row['username'] . '</td>';
                        echo '</tr>';
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Daftar Akun -->
        <h2 class="mt-5">Daftar Akun</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    while ($akun_row = mysqli_fetch_assoc($akun_result)) {
        echo '<tr>';
        echo '<td>' . $akun_row['id'] . '</td>';
        echo '<td>' . $akun_row['username'] . '</td>';
        echo '<td>';
        if ($akun_row['id'] != $_SESSION['id']) {
            $query_admin_check = "SELECT is_admin FROM akun WHERE id = " . $akun_row['id'];
            $admin_result = mysqli_query($connection, $query_admin_check);
            $admin_row = mysqli_fetch_assoc($admin_result);
            $is_admin = $admin_row['is_admin'];

            // Tombol untuk menaikkan atau menurunkan status admin
            echo ($is_admin == 1) 
                ? '<a href="../admin/crud.php?action=remove_admin&id=' . $akun_row['id'] . '" class="btn btn-success">Copot Admin</a> '
                : '<a href="../admin/crud.php?action=make_admin&id=' . $akun_row['id'] . '" class="btn btn-success">Jadikan Admin</a> ';

            // Tombol delete admin
            echo '<a href="../admin/crud.php?action=delete&id=' . $akun_row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Yakin ingin menghapus admin ini?\')">Hapus Akun</a>';
        }
        echo '</td>';
        echo '</tr>';
    }
    ?>
</tbody>

            </table>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center">
            <button class="btn btn-back" onclick="history.back()">Kembali</button>
        </div>
    </div>
</body>

</html>
