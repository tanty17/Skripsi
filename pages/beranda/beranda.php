<?php
// Include file konfigurasi database
include './conf/conf.php';

// Query untuk mengambil jumlah user
$sqlUser = "SELECT COUNT(*) AS totalUser FROM users";
$resultUser = $conn->query($sqlUser);
$totalUser = 0;
if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $totalUser = $rowUser['totalUser'];
}

// Query untuk mengambil jumlah data train
$sqlDataTrain = "SELECT COUNT(*) AS totalDataTrain FROM data_mahasiswa";
$resultDataTrain = $conn->query($sqlDataTrain);
$totalDataTrain = 0;
if ($resultDataTrain->num_rows > 0) {
    $rowDataTrain = $resultDataTrain->fetch_assoc();
    $totalDataTrain = $rowDataTrain['totalDataTrain'];
}

// Query untuk mengambil jumlah data prediksi
$sqlDataPrediksi = "SELECT COUNT(*) AS totalDataPrediksi FROM prediksi";
$resultDataPrediksi = $conn->query($sqlDataPrediksi);
$totalDataPrediksi = 0;
if ($resultDataPrediksi->num_rows > 0) {
    $rowDataPrediksi = $resultDataPrediksi->fetch_assoc();
    $totalDataPrediksi = $rowDataPrediksi['totalDataPrediksi'];
}
?>

<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                Jumlah User
                            </p>
                            <h5 class="font-weight-bolder mb-0">
                                <?php echo $totalUser; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                Data Train
                            </p>
                            <h5 class="font-weight-bolder mb-0">
                                <?php echo $totalDataTrain; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                Data Prediksi
                            </p>
                            <h5 class="font-weight-bolder mb-0">
                                <?php echo $totalDataPrediksi; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                            <p class="mb-1 pt-2 text-bold">Prediksi SVM dan Deep Learning (MLP)</p>
                            <h5 class="font-weight-bolder">SVM dan MLP (Multilayer Perceptron)
                            </h5>
                            <p class="mb-5">
                                SVM (Support Vector Machine) dan MLP (Multilayer Perceptron) adalah dua algoritma yang
                                umum digunakan dalam machine learning untuk berbagai jenis masalah, termasuk klasifikasi
                                dan regresi.
                            </p>
                            <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto disabled"
                                href="javascript:;">
                                SVM dan MLP
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                        <div class="bg-gradient-primary border-radius-lg h-100">
                            <img src="assets/img/shapes/waves-white.svg"
                                class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves" />
                            <div class="position-relative d-flex align-items-center justify-content-center h-100">
                                <img class="w-100 position-relative z-index-2 pt-4"
                                    src="assets/img/illustrations/rocket-white.png" alt="rocket" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-gradient-dark h-100">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <video controls class="w-100" muted autoplay style="border-radius: 10px;">
                        <source src="assets/video/svm.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <h5 class="text-white font-weight-bolder mb-4 pt-2">
                        SVM dan MLP
                    </h5>
                    <p class="text-white">
                        SVM adalah algoritma pembelajaran yang digunakan untuk pemisahan dua kelas dengan cara menemukan
                        hyperplane optimal yang memaksimalkan margin antara kelas-kelas tersebut.
                    </p>

                    <p class="text-white">
                        MLP adalah jenis arsitektur jaringan saraf tiruan (Neural Network) yang terdiri dari setidaknya
                        tiga lapisan: lapisan input, satu atau lebih lapisan tersembunyi (hidden layer), dan lapisan
                        output.
                    </p>

                </div>
            </div>
        </div>
    </div>

</div>