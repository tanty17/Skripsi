<?php
@$page = $_GET['q'];
if (!empty($page)) {
    switch ($page) {

        case 'beranda':
            include './pages/beranda/beranda.php';
            break;

        case 'train':
            include './pages/train/train.php';
            break;

        case 'home':
            include './pages/home/home.php';
            break;


        case 'evaluasi':
            include './pages/evaluasi/evaluasi.php';
            break;

        case 'd_all':
            include './pages/home/d_all/d_all.php';
            break;

        case 'impor':
            include './pages/home/impor/impor.php';
            break;

        case 'predict':
            include './pages/predict/predict.php';
            break;

        case 'impor_predik':
            include './pages/predict/impor_predik/impor_predik.php';
            break;

        case 'predik_proses':
            include './pages/predict/predik_proses/predik_proses.php';
            break;

        case 'd_all_prediksi':
            include './pages/predict/d_all_prediksi/d_all_prediksi.php';
            break;
    }
} else {
    include './pages/beranda/beranda.php';
}