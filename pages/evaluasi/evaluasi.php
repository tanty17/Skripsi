<?php
// Include file konfigurasi atau koneksi database Anda
include './conf/conf.php';

// Fungsi untuk menghitung evaluasi model SVM dan MLP
function evaluateModel($resultPrediksi)
{
    // Inisialisasi variabel untuk menyimpan hasil evaluasi
    $metrics = [
        'svm' => [
            'accuracy' => 0,
            'precision' => 0,
            'recall' => 0,
            'f1_score' => 0,
        ],
        'mlp' => [
            'accuracy' => 0,
            'precision' => 0,
            'recall' => 0,
            'f1_score' => 0,
        ],
    ];

    // Inisialisasi counter untuk menghitung metrik
    $totalInstances = $resultPrediksi->num_rows;
    $svm_correct = 0;
    $mlp_correct = 0;
    $svm_tp = $svm_fp = $svm_fn = $mlp_tp = $mlp_fp = $mlp_fn = 0;

    while ($row = $resultPrediksi->fetch_assoc()) {
        // Predicted values
        $pred_svm = $row['prediksi_svm']; // Prediksi SVM
        $pred_mlp = $row['prediksi_mlp']; // Prediksi MLP

        // Evaluasi SVM
        if ($pred_svm == 'Lulus') { // Ganti dengan kondisi sesuai dengan skema prediksi Anda
            $svm_correct++;
            $svm_tp++; // Jika benar positif
        } else {
            $svm_fn++; // Jika salah negatif
        }
        if ($pred_svm == 'Tidak Lulus') { // Ganti dengan kondisi sesuai dengan skema prediksi Anda
            $svm_fp++;
        }

        // Evaluasi MLP
        if ($pred_mlp == 'Lulus') { // Ganti dengan kondisi sesuai dengan skema prediksi Anda
            $mlp_correct++;
            $mlp_tp++; // Jika benar positif
        } else {
            $mlp_fn++; // Jika salah negatif
        }
        if ($pred_mlp == 'Tidak Lulus') { // Ganti dengan kondisi sesuai dengan skema prediksi Anda
            $mlp_fp++;
        }
    }

    // Hitung metrik untuk SVM
    $metrics['svm']['accuracy'] = $totalInstances > 0 ? $svm_correct / $totalInstances : 0;
    $precision_svm = ($svm_tp + $svm_fp) > 0 ? $svm_tp / ($svm_tp + $svm_fp) : 0;
    $recall_svm = ($svm_tp + $svm_fn) > 0 ? $svm_tp / ($svm_tp + $svm_fn) : 0;
    $metrics['svm']['precision'] = $precision_svm;
    $metrics['svm']['recall'] = $recall_svm;
    $metrics['svm']['f1_score'] = ($precision_svm + $recall_svm) > 0 ? 2 * (($precision_svm * $recall_svm) / ($precision_svm + $recall_svm)) : 0;

    // Hitung metrik untuk MLP
    $metrics['mlp']['accuracy'] = $totalInstances > 0 ? $mlp_correct / $totalInstances : 0;
    $precision_mlp = ($mlp_tp + $mlp_fp) > 0 ? $mlp_tp / ($mlp_tp + $mlp_fp) : 0;
    $recall_mlp = ($mlp_tp + $mlp_fn) > 0 ? $mlp_tp / ($mlp_tp + $mlp_fn) : 0;
    $metrics['mlp']['precision'] = $precision_mlp;
    $metrics['mlp']['recall'] = $recall_mlp;
    $metrics['mlp']['f1_score'] = ($precision_mlp + $recall_mlp) > 0 ? 2 * (($precision_mlp * $recall_mlp) / ($precision_mlp + $recall_mlp)) : 0;

    return $metrics;
}

// Lakukan query untuk mendapatkan data prediksi
$sqlPrediksi = "SELECT nama, nim, ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8, prediksi_svm, prediksi_mlp FROM prediksi";
$resultPrediksi = $conn->query($sqlPrediksi);

// Evaluasi model dan dapatkan metrik
$evaluation_results = evaluateModel($resultPrediksi); // Fungsi ini mengembalikan array metrik evaluasi
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h6>Evaluation Metrics</h6>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Metric</th>
                        <th>SVM</th>
                        <th>MLP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Akurasi</td>
                        <td><?= round($evaluation_results['svm']['accuracy'] * 100, 2) ?>%</td>
                        <td><?= round($evaluation_results['mlp']['accuracy'] * 100, 2) ?>%</td>

                    </tr>
                    <tr>
                        <td>Precision</td>
                        <td><?= number_format($evaluation_results['svm']['precision'] * 100, 2) ?>%</td>
                        <td><?= number_format($evaluation_results['mlp']['precision'] * 100, 2) ?>%</td>

                    </tr>
                    <tr>
                        <td>Recall</td>
                        <td><?= number_format($evaluation_results['svm']['recall'] * 100, 2) ?>%</td>
                        <td><?= number_format($evaluation_results['mlp']['recall'] * 100, 2) ?>%</td>

                    </tr>
                    <tr>
                        <td>F1-score</td>
                        <td><?= number_format($evaluation_results['svm']['f1_score'], 2) ?></td>
                        <td><?= number_format($evaluation_results['mlp']['f1_score'], 2) ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-12">
            <!-- Canvas for Chart.js -->
            <canvas id="metricsChart"></canvas>
        </div>
    </div>
</div>

<script>
    // Ambil data metrik dari PHP
    var svmAccuracy = <?= round($evaluation_results['svm']['accuracy'] * 100, 2) ?>;
    var mlpAccuracy = <?= round($evaluation_results['mlp']['accuracy'] * 100, 2) ?>;
    var svmPrecision = <?= round($evaluation_results['svm']['precision'] * 100, 2) ?>;
    var mlpPrecision = <?= round($evaluation_results['mlp']['precision'] * 100, 2) ?>;
    var svmRecall = <?= round($evaluation_results['svm']['recall'] * 100, 2) ?>;
    var mlpRecall = <?= round($evaluation_results['mlp']['recall'] * 100, 2) ?>;
    var svmF1 = <?= round($evaluation_results['svm']['f1_score'] * 100, 2) ?>;
    var mlpF1 = <?= round($evaluation_results['mlp']['f1_score'] * 100, 2) ?>;

    // Buat chart menggunakan Chart.js
    var ctx = document.getElementById('metricsChart').getContext('2d');
    var metricsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Accuracy', 'Precision', 'Recall', 'F1-score'],
            datasets: [{
                label: 'SVM',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [svmAccuracy, svmPrecision, svmRecall, svmF1]
            }, {
                label: 'MLP',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [mlpAccuracy, mlpPrecision, mlpRecall, mlpF1]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '%'; // Tambahkan persen (%) di akhir angka
                        }
                    }
                }
            }
        }
    });
</script>