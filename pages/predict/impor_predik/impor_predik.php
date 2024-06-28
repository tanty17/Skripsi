<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impor Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php
    include './conf/conf.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $csvFile = $_FILES['file']['tmp_name'];

        // Hapus semua data sebelum mengimpor data baru
        $sqlDelete = "DELETE FROM prediksi";
        if ($conn->query($sqlDelete) === FALSE) {
            // Tampilkan SweetAlert jika terjadi kesalahan saat menghapus data
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error deleting data: " . $conn->error . "',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '?q=predict';
                });
              </script>";
            exit();
        }

        // Prepare statement untuk insert data
        $sqlInsert = $conn->prepare("INSERT INTO prediksi (nama, nim, ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8, prediksi_svm, prediksi_mlp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Baca file CSV
        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            // Loop melalui setiap baris dalam file CSV
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Bind parameter ke statement
                $sqlInsert->bind_param("ssssssssssss", $nama, $nim, $ipk_1, $ipk_2, $ipk_3, $ipk_4, $ipk_5, $ipk_6, $ipk_7, $ipk_8, $prediksi_svm, $prediksi_mlp);

                // Masukkan data dari file CSV ke tabel database
                $nama = $data[0];
                $nim = $data[1];
                $ipk_1 = $data[2];
                $ipk_2 = $data[3];
                $ipk_3 = $data[4];
                $ipk_4 = $data[5];
                $ipk_5 = $data[6];
                $ipk_6 = $data[7];
                $ipk_7 = $data[8];
                $ipk_8 = $data[9];
                $prediksi_svm = $data[10]; // Kolom Prediksi SVM
                $prediksi_mlp = $data[11]; // Kolom Prediksi MLP

                // Eksekusi statement
                if ($sqlInsert->execute() === FALSE) {
                    // Tampilkan SweetAlert jika terjadi kesalahan saat mengimpor data
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error inserting data: " . $conn->error . "',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '?q=predict';
                        });
                      </script>";
                    exit();
                }
            }
            fclose($handle);
            // Tampilkan SweetAlert jika impor data berhasil
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data has been imported successfully',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '?q=predict';
                });
              </script>";
        } else {
            // Tampilkan SweetAlert jika terjadi kesalahan saat membuka file
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error opening file',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '?q=predict';
                });
              </script>";
        }

        // Tutup statement
        $sqlInsert->close();
    } else {
        // Tampilkan SweetAlert jika tidak ada file yang diunggah atau metode permintaan tidak valid
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No file uploaded or invalid request method.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '?q=predict';
            });
          </script>";
    }
    ?>


</body>

</html>