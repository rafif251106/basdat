<?php
include_once "./auth.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="no_print">
        <?php require_once "./include/navbar.php" ?>
    </div>
    <div class="row mt-4 ms-3 me-3">
        <div class="col-sm-6">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title">Laporan Terminal</h5>
                    <p class="card-text">Melihat laporan pengeluaran produk setiap terminal</p>
                    <a href="./lprterminal.php" class="btn btn-primary w-100">Laporan Terminal</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title">Laporan SPBU</h5>
                    <p class="card-text">Melihat laporan pemasukan jumlah liter setiap SPBU</p>
                    <a href="./lprspbu.php" class="btn btn-primary w-100">Laporan SPBU</a>
                </div>
            </div>
        </div>
    </div>
</body>