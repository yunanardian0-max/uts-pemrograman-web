<?php
include 'koneksi.php';

$id = "";
$judul = "";
$pengarang = "";
$tahun = "";
$fotoLama = "";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'");

    $data = mysqli_fetch_assoc($query);

    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $tahun = $data['tahun_terbit'];
    $fotoLama = $data['foto'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>
        <?= isset($_GET['id']) ? 'Edit Data' : 'Tambah Data'; ?>
    </h1>

    <form action="simpan.php"
          method="POST"
          enctype="multipart/form-data"
          onsubmit="return validasiForm()">

        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="foto_lama" value="<?= $fotoLama; ?>">

        <label>Judul Buku</label>
        <input type="text" name="judul" id="judul"
               value="<?= $judul; ?>">

        <label>Pengarang</label>
        <input type="text" name="pengarang" id="pengarang"
               value="<?= $pengarang; ?>">

        <label>Tahun Terbit</label>
        <input type="text" name="tahun" id="tahun"
               value="<?= $tahun; ?>">

        <label>Foto Sampul</label>
        <input type="file" name="foto" id="foto">

        <?php if ($fotoLama != "") : ?>
            <img src="uploads/<?= $fotoLama; ?>" width="120">
        <?php endif; ?>

        <button type="submit" class="btn">
            Simpan
        </button>

        <a href="index.php" class="kembali">
            Kembali
        </a>

    </form>

</div>

<script>

function validasiForm() {

    let judul = document.getElementById("judul").value;
    let pengarang = document.getElementById("pengarang").value;
    let tahun = document.getElementById("tahun").value;
    let foto = document.getElementById("foto");

    if (judul == "" || pengarang == "" || tahun == "") {

        alert("Semua field wajib diisi!");
        return false;
    }

    if (foto.files.length > 0) {

        let file = foto.files[0];

        let ekstensi = ['image/jpeg', 'image/png', 'image/jpg'];

        if (!ekstensi.includes(file.type)) {

            alert("File harus JPG atau PNG!");
            return false;
        }

        if (file.size > 2 * 1024 * 1024) {

            alert("Ukuran maksimal 2MB!");
            return false;
        }
    }

    return true;
}

</script>

</body>
</html>