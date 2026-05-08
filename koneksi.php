<?php

$conn = mysqli_connect("localhost", "root", "", "db_buku");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>