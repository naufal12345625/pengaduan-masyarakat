<?php
require_once '../service/database_example.php';

session_start();

$id = $_GET['id'];
$query = "SELECT * FROM report WHERE id_report = $id AND akun_id = " . $_SESSION['id'];
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['submit'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $query = "UPDATE report SET isi_laporan = '$isi_laporan' WHERE id_report = $id AND akun_id = " . $_SESSION['id'];
    if (mysqli_query($connection, $query)) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update report</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h3 class="text-center mb-0">Update report</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <form action="update.php?id=<?= $id ?>" method="post">
                            <div class="form-group mb-3">
                                <label for="isi_laporan" class="form-label">Isi Laporan</label>
                                <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5"><?= $row['isi_laporan'] ?></textarea>
                            </div>
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>