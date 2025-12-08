<?php
include_once "./auth.php";
include_once "./config.php";

$conn = connection();

$result_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengiriman");
$total_pengiriman = mysqli_fetch_assoc($result_total)['total'];

$result_jalan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengiriman WHERE status_pengiriman = 'perjalanan'");
$sedang_jalan = mysqli_fetch_assoc($result_jalan)['total'];

$result_armada = mysqli_query($conn, "SELECT COUNT(*) as total FROM kendaraan WHERE status_kendaraan = 'aktif'");
$armada_aktif = mysqli_fetch_assoc($result_armada)['total'];

$result_spbu = mysqli_query($conn, "SELECT COUNT(*) as total FROM spbu");
$total_spbu = mysqli_fetch_assoc($result_spbu)['total'];

$query_chart = "SELECT status_pengiriman, COUNT(*) as jumlah FROM pengiriman GROUP BY status_pengiriman";
$result_chart = mysqli_query($conn, $query_chart);
$labels_chart = [];
$data_chart = [];
while ($row = mysqli_fetch_assoc($result_chart)) {
    $labels_chart[] = ucfirst($row['status_pengiriman']);
    $data_chart[] = $row['jumlah'];
}

$query_recent = "SELECT p.tanggal_kirim, t.nama_terminal, s.nama_spbu, k.plat_nomor, p.status_pengiriman 
                 FROM pengiriman p 
                 JOIN terminal t ON p.id_terminal = t.id_terminal 
                 JOIN spbu s ON p.id_spbu = s.id_spbu 
                 JOIN kendaraan k ON p.id_kendaraan = k.id_kendaraan 
                 ORDER BY p.id_pengiriman DESC LIMIT 5";
$recent_pengiriman = mysqli_fetch_all(mysqli_query($conn, $query_recent), MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Distribusi BBM</title>

    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/navbar.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php require_once __DIR__ . "/include/navbar.php"; ?>

    <div class="container">
        <div class="dashboard-container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Selamat Datang, <?php echo ucwords($_SESSION['nama']); ?>!</h2>
                    <p class="text-muted">Anda login sebagai <strong><?php echo strtoupper($_SESSION['level']); ?></strong>. Berikut adalah ringkasan operasional hari ini.</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat bg-gradient-primary h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengiriman</div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $total_pengiriman ?> Data</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat bg-gradient-warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Sedang Dalam Perjalanan</div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $sedang_jalan ?> Armada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat bg-gradient-success h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Kendaraan Aktif</div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $armada_aktif ?> Unit</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-stat bg-gradient-info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Total Mitra SPBU</div>
                                    <div class="h5 mb-0 font-weight-bold"><?= $total_spbu ?> Lokasi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white">
                            <h5 class="m-0 font-weight-bold text-primary">Aktivitas Pengiriman Terakhir</h5>
                            <a href="pengiriman.php" class="btn btn-sm btn-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Tujuan (SPBU)</th>
                                            <th>Kendaraan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recent_pengiriman as $rp): ?>
                                            <tr>
                                                <td><?= $rp['tanggal_kirim'] ?></td>
                                                <td><?= $rp['nama_spbu'] ?></td>
                                                <td><?= $rp['plat_nomor'] ?></td>
                                                <td>
                                                    <?php
                                                    $badge_color = 'secondary';
                                                    if ($rp['status_pengiriman'] == 'selesai') $badge_color = 'success';
                                                    elseif ($rp['status_pengiriman'] == 'perjalanan') $badge_color = 'warning text-dark';
                                                    elseif ($rp['status_pengiriman'] == 'dibatalkan') $badge_color = 'danger';
                                                    elseif ($rp['status_pengiriman'] == 'terjadwal') $badge_color = 'primary';
                                                    ?>
                                                    <span class="badge bg-<?= $badge_color ?>"><?= ucfirst($rp['status_pengiriman']) ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($recent_pengiriman)): ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada data pengiriman.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-white">
                            <h5 class="m-0 font-weight-bold text-primary">Statistik Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="statusChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small text-muted">
                                Distribusi status keseluruhan data pengiriman.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
        Chart.defaults.font.family = 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.color = '#858796';

        var ctx = document.getElementById("statusChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($labels_chart) ?>,
                datasets: [{
                    data: <?= json_encode($data_chart) ?>,
                    backgroundColor: ['#1cc88a', '#f6c23e', '#4e73df', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#dda20a', '#2e59d9', '#be2617'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom'
                },
                cutout: '70%',
            },
        });
    </script>
</body>

</html>