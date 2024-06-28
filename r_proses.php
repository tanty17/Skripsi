<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Proses</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php
    session_start();
    include 'conf/conf.php'; // Pastikan Anda memiliki file konfigurasi untuk koneksi database

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Validasi input
        if (empty($username) || empty($password)) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Username dan Password wajib diisi!'
            }).then(() => {
                window.location.href = 'register.php';
            });
        </script>";
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database dengan role 'user'
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil!',
                    text: 'Silakan login.'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>";
                exit();
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Coba lagi nanti.'
                }).then(() => {
                    window.location.href = 'register.php';
                });
            </script>";
                exit();
            }
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan. Coba lagi nanti.'
            }).then(() => {
                window.location.href = 'register.php';
            });
        </script>";
            exit();
        }
    } else {
        header("Location: register.php");
    }
    ?>


</body>

</html>