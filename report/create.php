<?php
require_once '../service/database_example.php';

if (isset($_POST['submit'])) {
    session_start();
    
    // Validasi sesi
    if (!isset($_SESSION['id'])) {
        header("Location: ../auth/login.php");
        exit();
    }
    
    // Sanitasi input
    $isi_laporan = mysqli_real_escape_string($connection, $_POST['isi_laporan']);
    $akun_id = intval($_SESSION['id']);
    
    // Gunakan prepared statement
    $stmt = $connection->prepare("INSERT INTO report (isi_laporan, akun_id) VALUES (?, ?)");
    $stmt->bind_param("si", $isi_laporan, $akun_id);
    
    if ($stmt->execute()) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Membuat Report</title>
    <style>
        /* General Styling */
        body {
            background: linear-gradient(to right, #4caf50, #81c784);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
        }

        /* Card Styling */
        .card {
            background: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-header {
            background: linear-gradient(to right, #388e3c, #66bb6a);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Form Styling */
        .form-control {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #388e3c;
            box-shadow: 0 0 10px rgba(56, 142, 60, 0.5);
        }

        textarea::placeholder {
            font-style: italic;
            color: #999;
        }

        /* Button Styling */
        .btn-submit {
            background: #388e3c;
            color: white;
            font-size: 1.2rem;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #2e7d32;
            transform: scale(1.05);
        }

        .btn-back {
            background-color: #8d8d8d;
            color: white;
            margin-top: 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-back:hover {
            background-color: #6c757d;
            transform: scale(1.05);
        }

        /* Alert Styling */
        .alert {
            border-radius: 10px;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.2rem;
            }

            .btn-submit {
                font-size: 1rem;
            }

            textarea {
                height: 120px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Membuat Report
            </div>
            <div class="card-body p-4">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <form action="create.php" method="post">
                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5" placeholder="Jelaskan permasalahan Anda dengan rinci..." required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-submit btn-lg">Submit</button>
                    </div>
                </form>
                <div class="d-grid mt-3">
                    <button class="btn btn-back" onclick="location.href='../index.php'">Kembali ke Halaman Awal</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
