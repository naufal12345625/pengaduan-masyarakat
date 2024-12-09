<?php
session_start();
require_once '../service/database_example.php';

// Validasi sesi
if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$query = "SELECT * FROM report WHERE akun_id = " . intval($_SESSION['id']);
$result = mysqli_query($connection, $query);

// Tangani jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($connection));
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pengaduan Saya</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            margin-bottom: 30px;
            color: #343a40;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .btn-back {
            margin-bottom: 20px;
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-back:hover {
            background-color: #5a6268;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Pengaduan Saya</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button class="btn btn-back" onclick="location.href='../index.php'">Kembali ke Halaman Awal</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Isi Laporan</th>
                            <th scope="col">Tanggal Report</th>
                            <th scope="col">Aksi</th>
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
                            echo '<td>';
                            echo '<a href="../report/update.php?id=' . $row['id_report'] . '" class="btn btn-success btn-sm">Update</a> ';
                            echo '<a href="../report/delete.php?id=' . $row['id_report'] . '" class="btn btn-danger btn-sm">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
