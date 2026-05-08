<?php
include 'koneksi.php';

$id = $_POST['id'];

$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$tahun = $_POST['tahun'];

$fotoLama = $_POST['foto_lama'];

$namaFoto = $fotoLama;

if ($_FILES['foto']['name'] != "") {

    $fileName = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {

        die("Format file tidak valid");
    }

    if ($size > 2 * 1024 * 1024) {

        die("Ukuran file terlalu besar");
    }

    $namaFoto = time() . '_' . $fileName;

    move_uploaded_file($tmpName, 'uploads/' . $namaFoto);

    if ($fotoLama != "" && file_exists('uploads/' . $fotoLama)) {

        unlink('uploads/' . $fotoLama);
    }
}

if ($id == "") {

    mysqli_query($conn,
        "INSERT INTO buku
        VALUES (
            NULL,
            '$judul',
            '$pengarang',
            '$tahun',
            '$namaFoto'
        )"
    );

    echo "
    <script>
        alert('Data berhasil ditambah');
        window.location='index.php';
    </script>
    ";

} else {

    mysqli_query($conn,
        "UPDATE buku SET
            judul='$judul',
            pengarang='$pengarang',
            tahun_terbit='$tahun',
            foto='$namaFoto'
        WHERE id='$id'
        "
    );

    echo "
    <script>
        alert('Data berhasil diupdate');
        window.location='index.php';
    </script>
    ";
}
?>