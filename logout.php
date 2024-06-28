<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <?php
    session_start();

    // Menghapus semua variabel sesi
    session_unset();

    // Menghancurkan sesi
    session_destroy();

    // Redirect ke halaman login atau halaman lainnya jika perlu
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Logout!',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>";
    ?>
</body>

</html>