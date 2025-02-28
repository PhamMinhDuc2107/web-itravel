<?php
$totalPriceMonth =  $data['totalPriceMonth'][0] ?? [];
$totalPriceDay =  $data['totalPriceDay'] ?? [];
$totalConsultation =  $data['totalConsultation'][0] ?? [];
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng tiền của tháng <?php echo $data['month']?></p>
                                <h5 class="font-weight-bolder">
                                    <?php echo number_format($totalPriceMonth['total_price_monthly'], 0, '.', ',');?>
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+55%</span>
                                    since yesterday
                                </p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle ">
                                <i class="fa-solid fa-money-check-dollar" style="font-size: 20px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng số đơn trong tháng</p>
                                <h5 class="font-weight-bolder">
                                    <?php echo $totalPriceMonth['total_order_monthly']?>
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    since last week
                                </p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fa-solid fa-cart-shopping text-white" style="font-size: 20px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                <h5 class="font-weight-bolder">
                                    +3,462
                                </h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    since last quarter
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Khách hàng cần tư vấn </p>
                                <h5 class="font-weight-bolder">
                                    <?php echo $totalConsultation['total']?>
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                </p>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa-solid fa-comment-medical" style="font-size: 20px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Bảng thống kê</h6>
                    <div class="mb-3 col-1">
                        <div class="dropdown">
                           <?php
                           $month = $data['month'];
                           ?>
                            <input class="form-control" type="text" value="<?php echo "Tháng ".$month?>" data-month="<?php echo $month?>" placeholder=""  id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true" />
                            <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1" style="max-height: 250px;overflow-y:scroll">
                                  <?php for($i = 1; $i <= date('m'); $i++):?>
                                       <li><a href="<?php echo Util::buildMonthUrl($i)?>" class="dropdown-item" data-value="<?php echo $i?>"><?php echo "Tháng ".$i?></a></li>
                                  <?php endfor;?>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $day = [];
    $price_day = [];
    foreach ($totalPriceDay as $key => $value) {
        $price_day[] = $value['total_price_day'];
        $day[] = $value['ngay'];
    }

?>
<script src="<?php echo ASSET?>/admin/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo ASSET?>/admin/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo ASSET?>/admin/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: <?php echo json_encode($day)?>,
            datasets: [{
                label: "Doanh thu",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: <?php echo json_encode($price_day)?>,
                maxBarThickness: 6
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script src="<?php echo ASSET?>/admin/js/argon-dashboard.min.js?v=2.1.0"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll(".dropdown").forEach((dropdown) => {
            let input = dropdown.querySelector('input');
            let dropdownMenu = dropdown.querySelector(".dropdown-menu");
            if(dropdownMenu) {
                dropdownMenu.addEventListener('click', (e) => {
                    if (e.target.classList.contains('dropdown-item')) {
                       input.dataset.month = e.target.dataset.value;
                        input.value = e.target.textContent;

                    }
                });
            }
        });
    })
</script>