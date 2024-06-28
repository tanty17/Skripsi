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

    function sigmoid($x)
    {
        return 1 / (1 + exp(-$x));
    }

    function predictSVM($sample)
    {
        $threshold = 2.75;
        $total = 0;
        foreach ($sample as $value) {
            $total += $value;
        }
        $average = $total / count($sample);
        return $average >= $threshold;
    }

    function predictMLP($sample)
    {
        $thresholds = [2.75, 2.75, 2.75, 2.75, 2.75, 2.75, 2.75, 2.75];
        $weights = [
            'input_hidden' => [[0.1, 0.2], [0.3, 0.4], [0.5, 0.6], [0.7, 0.8], [0.9, 1.0], [0.1, 0.2], [0.3, 0.4], [0.5, 0.6]],
            'hidden_output' => [0.5, 0.6]
        ];

        $h_input = [];
        foreach ($weights['input_hidden'] as $weights_input) {
            $h_input[] = array_sum(array_map(function ($x, $y) {
                return $x * $y;
            }, $sample, $weights_input));
        }
        $h_output = array_map('sigmoid', $h_input);

        $o_input = array_sum(array_map(function ($h, $w) {
            return $h * $w;
        }, $h_output, $weights['hidden_output']));
        $o_output = sigmoid($o_input);

        // Check if each column meets the passing threshold
        foreach ($sample as $key => $value) {
            if ($value < $thresholds[$key]) {
                return false; // Jika salah satu kolom tidak memenuhi standar, langsung return Tidak Lulus
            }
        }

        return $o_output > 0.5; // Jika semua kolom memenuhi standar, gunakan hasil dari MLP untuk prediksi
    }

    $sql = "SELECT id, nama, nim, ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8 FROM data_mahasiswa";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sample = [
                $row['ipk_1'], $row['ipk_2'], $row['ipk_3'], $row['ipk_4'],
                $row['ipk_5'], $row['ipk_6'], $row['ipk_7'], $row['ipk_8']
            ];

            $resultSVM = predictSVM($sample);
            $resultMLP = predictMLP($sample);
            $prediksiSVM = $resultSVM ? 'Lulus' : 'Tidak Lulus';
            $prediksiMLP = $resultMLP ? 'Lulus' : 'Tidak Lulus';

            $sqlCheck = "SELECT id FROM prediksi WHERE nim = '{$row['nim']}'";
            $checkResult = $conn->query($sqlCheck);
            if ($checkResult->num_rows > 0) {
                $sqlUpdate = "UPDATE prediksi SET prediksi_svm = '$prediksiSVM', prediksi_mlp = '$prediksiMLP' WHERE nim = '{$row['nim']}'";
                if ($conn->query($sqlUpdate) === FALSE) {
                    // Tampilkan SweetAlert jika terjadi kesalahan saat memperbarui data
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating data: " . $conn->error . "',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = '?q=predict';
                        });
                      </script>";
                    exit();
                }
            } else {
                $sqlInsert = "INSERT INTO prediksi (nama, nim, ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8, prediksi_svm, prediksi_mlp) 
            VALUES ('{$row['nama']}', '{$row['nim']}', '{$row['ipk_1']}', '{$row['ipk_2']}', '{$row['ipk_3']}', '{$row['ipk_4']}', 
            '{$row['ipk_5']}', '{$row['ipk_6']}', '{$row['ipk_7']}', '{$row['ipk_8']}', '$prediksiSVM', '$prediksiMLP')";
                if ($conn->query($sqlInsert) === FALSE) {
                    // Tampilkan SweetAlert jika terjadi kesalahan saat memasukkan data baru
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
        }
        // Tampilkan SweetAlert jika proses prediksi berhasil dan alihkan ke halaman predict.php
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Prediction has been completed successfully',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '?q=predict';
            });
          </script>";
    } else {
        echo "No data found";
    }
    ?>



</body>

</html>