<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
    "SELECT * FROM buku WHERE id='$id'"
);

$data = mysqli_fetch_assoc($query);

if (file_exists('uploads/' . $data['foto'])) {

    unlink('uploads/' . $data['foto']);
}

mysqli_query($conn,
    "DELETE FROM buku WHERE id='$id'"
);

echo "
<script>
    alert('Data berhasil dihapus');
    window.location='index.php';
</script>
";
?>