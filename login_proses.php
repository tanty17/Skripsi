<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Proses</title>
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
                window.location.href = 'index.php';
            });
        </script>";
            exit();
        }

        // Cek pengguna di database
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password benar, buat session
                            $_SESSION['username'] = $username;
                            $_SESSION['role'] = $role;
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                            echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Login successful!',
                                text: 'Hai, $username. Selamat datang!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = 'my.php';
                            });
                        </script>";
                            exit();
                        } else {
                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Password salah!'
                            }).then(() => {
                                window.location.href = 'index.php';
                            });
                        </script>";
                            exit();
                        }
                    }
                } else {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Username tidak ditemukan!'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                </script>";
                    exit();
                }
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan. Coba lagi nanti!'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>";
                exit();
            }
            mysqli_stmt_close($stmt);
        }

        mysqli_close($conn);
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
    ?>


</body>

</html>