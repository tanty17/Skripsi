<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Data Prediksi</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php
    // Include file konfigurasi database
    include './conf/conf.php';

    // Cek apakah parameter q bernilai delete_prediksi
    if (isset($_GET['q']) && $_GET['q'] === 'd_all_prediksi') {
        // Lakukan query untuk menghapus semua data pada tabel prediksi
        $sqlDelete = "TRUNCATE TABLE prediksi";
        if ($conn->query($sqlDelete) === TRUE) {
            // Tampilkan SweetAlert jika penghapusan berhasil
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'All data in prediksi have been deleted successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '?q=predict';
                });
              </script>";
            exit();
        } else {
            // Tampilkan SweetAlert jika terjadi kesalahan saat menghapus data
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error deleting records: " . $conn->error . "',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '?q=predict';
                });
              </script>";
        }
    }
    ?>

</body>

</html>