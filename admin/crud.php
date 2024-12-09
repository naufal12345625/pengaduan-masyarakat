<?php
session_start();
require_once '../service/database_example.php';

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == 0) {
    header('Location: ../index.php');
    exit();
}

// Tangkap ID dan aksi
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action == 'toggle_admin') {
        // Ubah status admin
        $query = "UPDATE akun SET is_admin = CASE WHEN is_admin = 1 THEN 0 ELSE 1 END WHERE id = $id";
        if (mysqli_query($connection, $query)) {
            header('Location: ../admin/index.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    } elseif ($action == 'delete') {
        // Hapus akun
        $query = "DELETE FROM akun WHERE id = $id";
        if (mysqli_query($connection, $query)) {
            header('Location: ../admin/index.php');
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "ID or action not provided.";
}
?>
