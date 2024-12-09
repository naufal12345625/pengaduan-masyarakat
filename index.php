<?php
session_start();
include './service/database_example.php';

// Menangani sesi default
if (!isset($_SESSION['is_admin'])) {
    $_SESSION['is_admin'] = 0; // Default: bukan admin
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Website Pengaduan</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: linear-gradient(90deg, #ff7eb3, #ff758c);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-dark .nav-link {
            color: white !important;
            transition: color 0.3s ease;
        }

        .navbar-dark .nav-link:hover {
            color: #ffe5d9 !important;
            text-decoration: underline;
        }

        .hero-section {
            padding: 80px 20px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            border-radius: 15px;
            margin-top: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .hero-section h1 {
            font-weight: bold;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .card {
            border: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .btn-dark-blue {
            background-color: #1d3557;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-dark-blue:hover {
            background-color: #16324f;
            transform: scale(1.05);
        }

        footer {
            background-color: #1d3557;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer a {
            color: #fca311;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ff8c00;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Pengaduan Masyarakat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (!isset($_SESSION['id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/register.php">Register</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Report
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./akun/self.php">Pengaduan Saya</a></li>
                                <li><a class="dropdown-item" href="./report/create.php">Buat Pengaduan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/logout.php">Logout</a>
                        </li>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./admin/index.php">Admin</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mt-4">
        <div class="hero-section">
            <h1>Selamat Datang, <?= $_SESSION['username'] ?? 'Pengunjung' ?>!</h1>
            <p>Website ini membantu Anda menyampaikan pengaduan dengan mudah dan cepat.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Pengaduan Saya</h5>
                        <p class="card-text">Lihat laporan yang telah Anda ajukan.</p>
                        <a href="./akun/self.php" class="btn btn-dark-blue">Lihat Laporan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Buat Pengaduan</h5>
                        <p class="card-text">Ajukan laporan pengaduan baru dengan mudah.</p>
                        <a href="./report/create.php" class="btn btn-dark-blue">Buat Pengaduan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Admin</h5>
                        <p class="card-text">Kelola laporan masyarakat (khusus Admin).</p>
                        <a href="./admin/index.php" class="btn btn-dark-blue">Kelola</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Pengaduan Masyarakat. All Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Contact</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
