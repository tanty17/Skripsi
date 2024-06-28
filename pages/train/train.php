<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

    <?php
    include './conf/conf.php';

    $sql = "SELECT ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8, prediksi_svm, prediksi_mlp FROM data_mahasiswa";
    $result = $conn->query($sql);

    $samples = [];
    $labels_svm = [];
    $labels_mlp = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $samples[] = [
                $row['ipk_1'], $row['ipk_2'], $row['ipk_3'], $row['ipk_4'],
                $row['ipk_5'], $row['ipk_6'], $row['ipk_7'], $row['ipk_8']
            ];
            $labels_svm[] = $row['prediksi_svm'];
            $labels_mlp[] = $row['prediksi_mlp'];
        }
    } else {
        $conn->close();
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No data found to train the model.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '?q=home';
            });
        </script>";
        exit();
    }

    $data = [
        'samples' => $samples,
        'labels_svm' => $labels_svm,
        'labels_mlp' => $labels_mlp
    ];
    if (file_put_contents('data.json', json_encode($data)) === FALSE) {
        $conn->close();
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to save data.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '?q=home';
            });
        </script>";
        exit();
    }

    $conn->close();

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Model successfully trained.',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = '?q=predict';
        });
    </script>";
    exit();
    ?>

</body>

</html>