<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete All Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php
    include './conf/conf.php';

    // Hapus semua data dari tabel data_mahasiswa
    $sqlDeleteDataMahasiswa = "DELETE FROM data_mahasiswa";
    if ($conn->query($sqlDeleteDataMahasiswa) === TRUE) {
        // Tampilkan SweetAlert jika penghapusan berhasil
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Berhasil Menghapus Data Train',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '?q=home';
                });
              </script>";
    } else {
        // Tampilkan SweetAlert jika penghapusan gagal
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal Menghapus Data: <?php echo $conn->error; ?>',
    showConfirmButton: false,
    timer: 1500
    }).then(function() {
    window.location.href = '?q=home';
    });
    </script>";
    }

    ?>
</body>

</html>