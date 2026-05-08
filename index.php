<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Data Buku</h1>

    <a href="form.php" class="btn">+ Tambah Data</a>

    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        while ($data = mysqli_fetch_assoc($query)) :
        ?>

        <tr>
            <td><?= $no++; ?></td>

            <td>
                <img src="uploads/<?= $data['foto']; ?>" width="80">
            </td>

            <td><?= $data['judul']; ?></td>
            <td><?= $data['pengarang']; ?></td>
            <td><?= $data['tahun_terbit']; ?></td>

            <td>
                <a href="form.php?id=<?= $data['id']; ?>" class="edit">
                    Edit
                </a>

                <a href="hapus.php?id=<?= $data['id']; ?>"
                   class="hapus"
                   onclick="return confirm('Yakin ingin hapus data?')">
                    Hapus
                </a>
            </td>
        </tr>

        <?php endwhile; ?>

    </table>

</div>

</body>
</html>