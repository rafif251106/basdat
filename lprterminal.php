<?php
include_once "./auth.php";
$conn = mysqli_connect("localhost", "root", "", "distribusi_bbm");

function validatetanggal(&$error, $tanggalaw, $tanggalak)
{
    if (empty($tanggalaw) || empty($tanggalak)) {
        $error['tanggalaw'] = "Tanggal tidak boleh kosong";
        $error['tanggalak'] = "Tanggal tidak boleh kosong";
    } elseif ($tanggalaw > $tanggalak) {
        $error['tanggalgab'] = "Tanggal awal tidak boleh kurang dari tanggal akhir";
    }
}

function validateterminal(&$error, $field)
{
    if ($field == "Pilih Terminal") {
        $error['pilih'] = "Tidak boleh dipilih";
    }
}

$query = "SELECT t.id_terminal,t.nama_terminal FROM terminal t";
$result = mysqli_query($conn, $query);
$terminal = mysqli_fetch_all($result, MYSQLI_ASSOC);

$error = [];
if (isset($_POST['tampil']) || isset($_POST['excel'])) {
    if (!empty($_POST['terminal'])) {
        $idterminal = $_POST['terminal'] ?? "";
        $tanggalaw = $_POST['tanggalaw'] ?? "";
        $tanggalak = $_POST['tanggalak'] ?? "";
        validatetanggal($error, $tanggalaw, $tanggalak);
        validateterminal($error, $idterminal);
        if (count($error) == 0) {
            $query = "SELECT t.nama_terminal,pb.nama_produk,SUM(dp.jumlah_liter_produk) AS jumlah_liter,p.tanggal_kirim FROM pengiriman p JOIN terminal t ON t.id_terminal = p.id_terminal JOIN detail_pengiriman dp ON dp.id_pengiriman = p.id_pengiriman JOIN produk_bbm pb ON pb.id_produk = dp.id_produk WHERE t.id_terminal = '$idterminal' AND p.tanggal_kirim BETWEEN '$tanggalaw' AND '$tanggalak' GROUP BY dp.id_produk";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }

    if (isset($_POST['all']) == true) {
        $tanggalaw = $_POST['tanggalaw'] ?? "";
        $tanggalak = $_POST['tanggalak'] ?? "";
        validatetanggal($error, $tanggalaw, $tanggalak);
        if (count($error) == 0) {
            $query = "SELECT t.nama_terminal,pb.nama_produk,SUM(dp.jumlah_liter_produk) AS jumlah_liter,p.tanggal_kirim FROM pengiriman p JOIN terminal t ON t.id_terminal = p.id_terminal JOIN detail_pengiriman dp ON dp.id_pengiriman = p.id_pengiriman JOIN produk_bbm pb ON pb.id_produk = dp.id_produk WHERE p.tanggal_kirim BETWEEN '$tanggalaw' AND '$tanggalak' GROUP BY dp.id_produk";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
    if (isset($data)) {
        $namaproduk = [];
        foreach ($data as $d) {
            $nama = $d['nama_produk'];
            $namaproduk[] = $nama;
        }

        $jumlah_liter = [];
        foreach ($data as $d) {
            $jumlah = $d['jumlah_liter'];
            $jumlah_liter[] = (int)$jumlah;
        }
    }
}

if (isset($_POST['excel'])) {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    if (isset($_POST['all']) == true) {
        header("Content-Disposition: attachment; filename=allTerminal.xls");
    } else {
        header("Content-Disposition: attachment; filename=" . $data[0]['nama_terminal'] . ".xls");
    }

    echo "<h5>Rekap Laporan Pengeluaran Jumlah Liter Terminal</h5>";
    echo "<h2>" . $data[0]['nama_terminal'] . "</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Produk</th>
            <th>Jumlah Liter</th>
        </tr>";
    foreach ($data as $d) {
        echo "<tr>";
        echo "<td>" . $d['nama_produk'] . "</td>";
        echo "<td>" .  $d['jumlah_liter'] . "</td>";
        echo "</tr>";
    }
    exit;
}


if (isset($_POST['kembali'])) {
    header("location:./homepage.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./css/table.css">
    <style>
        @media print {
            .no_print {
                display: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            * {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

</head>

<body>
    <div class="no_print">
        <?php require_once "./include/navbar.php" ?>
    </div>
    <h2 style="text-align: center;">Laporan Jumlah Liter Terminal</h2>
    <div class="no_print">
        <form action="./laporan.php" method="post">
            <button type="submit" name="kembali" class="btn btn-danger ms-5">Kembali</button>
        </form>
        <div class="container-fluid" style="display: flex; justify-content:center;">
            <div class="card p-3">
                <div class="card-body">
                    <form action="lprterminal.php" method="post" style="padding:10px;width: 600px;">
                        <table>
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <label for="tanggalaw" class="form-label">Tanggal Awal:</label>
                                        <input type="date" name="tanggalaw" class="form-control" style="width: 300px;" value="<?= $tanggalaw ?>">
                                        <span><?php echo $error['tanggalaw'] ?? "" ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <label for="tanggalak" class="form-label">Tanggal Akhir:</label>
                                        <input type="date" name="tanggalak" class="form-control" style="width: 300px;" value="<?= $tanggalak ?>">
                                        <span><?php echo $error['tanggalak'] ?? "" ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span><?php echo $error['tanggalgab'] ?? "" ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="mb-3">
                                        <label for="terminal" class="form-label">Terminal:</label>
                                        <select class="form-select" aria-label="Default select example" name="terminal" id="terminal">
                                            <option selected>Pilih Terminal</option>
                                            <?php foreach ($terminal as $t): ?>
                                                <option value="<?= $t['id_terminal'] ?>"><?php echo $t['nama_terminal'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span><?php echo $error['pilih'] ?? "" ?></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="all" name="all">
                                        <label class="form-check-label" for="all">
                                            All Terminal
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="m-4">
                                <td colspan="2">
                                    <button type="submit" name="tampil" class="btn btn-success w-100 mt-1 mb-1">Tampilkan</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><?php echo $error['data'] ?? "" ?></span>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php if (isset($_POST['tampil'])): ?>
        <?php if (empty($data)): ?>
            <h2 style="text-align: center;">Data Kosong</h2>
        <?php elseif (count($error) == 0): ?>
            <div class="card">
                <div class="card-body">
                    <div class="no_print">
                        <form action="laporan.php" method="post">
                            <input type="hidden" name="tanggalaw" value="<?= $tanggalaw ?>">
                            <input type="hidden" name="tanggalak" value="<?= $tanggalak ?>">
                            <input type="hidden" name="terminal" value="<?= $idterminal ?>">
                            <?php if (isset($_POST['all']) == true): ?>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="all" hidden checked>
                            <?php else: ?>
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="all" hidden>
                            <?php endif; ?>
                            <button onclick="window.print()" class="btn btn-primary ms-5">Cetak</button>
                            <button type="submit" name="excel" class="btn btn-success ms-5">Excel</button>
                        </form>
                    </div>
                    <div style="width: auto; height: 500px;display: flex; justify-content:center;">
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?= json_encode($namaproduk) ?>,
                                datasets: [{
                                    label: "Liter",
                                    data: <?= json_encode($jumlah_liter) ?>,
                                    backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(255, 206, 86, 0.2)"],
                                    borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)", "rgba(255, 206, 86, 1)"],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                    }
                                }
                            }
                        });
                    </script>
                    <hr>
                    <div class="container">
                        <?php if (!empty($_POST['terminal'])): ?>
                            <h2><?php echo $data[0]['nama_terminal'] ?></h2>
                        <?php endif; ?>
                        <table border="1" cellpadding="15px" class="table table-light table-hover table-bordered border-primary">
                            <tr class="table-dark">
                                <th>Produk</th>
                                <th>Jumlah Liter</th>
                            </tr>
                            <?php foreach ($data as $d): ?>
                                <tr>
                                    <td><?php echo $d['nama_produk'] ?></td>
                                    <td><?php echo $d['jumlah_liter'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
</body>
<script>
    let terminal = document.getElementById('terminal');
    let all = document.getElementById('all');
    all.addEventListener('change', function() {
        if (this.checked) {
            terminal.disabled = true;
        } else {
            terminal.disabled = false;
        }
    });
</script>

</html>