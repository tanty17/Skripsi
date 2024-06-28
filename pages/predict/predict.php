<?php
include './conf/conf.php';
// Lakukan query untuk mendapatkan data prediksi
$sqlPrediksi = "SELECT nama, nim, ipk_1, ipk_2, ipk_3, ipk_4, ipk_5, ipk_6, ipk_7, ipk_8, prediksi_svm, prediksi_mlp FROM prediksi";
$resultPrediksi = $conn->query($sqlPrediksi);
?>

<?php if ($role === 'admin') : ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <a href="?q=d_all_prediksi" class="btn btn-danger mb-3">Delete Data</a>
                <button id="downloadBtn" class="btn btn-warning mb-3">Download CSV</button>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Data Uji</h6>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <a href="?q=predik_proses" class="btn btn-success ml-2">Predict Data</a>
                                </div>
                                <div>
                                    <form action="?q=impor_predik" method="post" enctype="multipart/form-data">
                                        <label for="file-upload" class="btn btn-info">Import Data</label>
                                        <input type="file" id="file-upload" name="file" style="display: none;" required>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3">
                            <table id="dataTable" class="table align-items-center mb-0 text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            4</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            5</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            6</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            7</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            8</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prediksi SVM</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prediksi MLP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($resultPrediksi->num_rows > 0) : ?>
                                        <?php while ($row = $resultPrediksi->fetch_assoc()) : ?>
                                            <tr>
                                                <td class='mb-0 text-sm'><?= $row['nama'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['nim'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_1'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_2'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_3'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_4'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_5'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_6'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_7'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_8'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['prediksi_svm'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['prediksi_mlp'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan='12'>No data found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>



<?php if ($role === 'user') : ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <button id="downloadBtn" class="btn btn-warning mb-3">Download CSV</button>
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Lapooran Data Uji</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-3">
                            <table id="dataTable" class="table align-items-center mb-0 text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            1</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            2</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            3</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            4</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            5</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            6</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            7</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IPK
                                            8</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prediksi SVM</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Prediksi MLP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($resultPrediksi->num_rows > 0) : ?>
                                        <?php while ($row = $resultPrediksi->fetch_assoc()) : ?>
                                            <tr>
                                                <td class='mb-0 text-sm'><?= $row['nama'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['nim'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_1'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_2'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_3'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_4'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_5'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_6'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_7'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['ipk_8'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['prediksi_svm'] ?></td>
                                                <td class='mb-0 text-sm'><?= $row['prediksi_mlp'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan='12'>No data found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ordering": false // Disable sorting
        });
    });
</script>