<?php
require_once 'database_example.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS akun (
        id INT AUTO_INCREMENT primary KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        is_admin BOOLEAN DEFAULT false
    )",
    "CREATE TABLE IF NOT EXISTS report (
        id_report INT AUTO_INCREMENT primary KEY,
        isi_laporan TEXT NOT NULL,
        tgl_report TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        akun_id INT,
        FOREIGN KEY (akun_id) REFERENCES akun(id)
    )",
];
foreach ($queries as $query) {
    if (mysqli_query($connection, $query)) {
        echo "Table created successfully<br>";
    } else {
        echo "Error creating table: " . mysqli_error($connection);
    }
}
