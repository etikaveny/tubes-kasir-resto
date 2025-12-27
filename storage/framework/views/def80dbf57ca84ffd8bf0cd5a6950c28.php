<?php $__env->startSection('content'); ?>
    <h2 class="fw-bold mb-4">Dashboard</h2>

    <div class="row g-4">
        <!-- Left Column: Chart & Table -->
        <div class="col-lg-8">
            <!-- Chart Section -->
            <div class="card border-0 rounded-4 shadow-sm mb-4" style="background-color: #EAE5D9;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-dark rounded-circle text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                            <i class="bi bi-bar-chart-fill"></i>
                        </div>
                        <h4 class="fw-bold m-0">Orderan Harian</h4>
                    </div>
                    <div style="position: relative; height: 180px; width: 100%;">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Staff Performance -->
            <div class="card border-0 rounded-4 shadow-sm mb-4" style="background-color: #EAE5D9;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-dark rounded-circle text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold m-0">Performa Staff</h4>
                    </div>

                    <table class="table table-borderless text-dark">
                        <thead>
                            <tr class="text-secondary fw-bold" style="border-bottom: 1px solid #999;">
                                <th class="pb-3">Nama</th>
                                <th class="pb-3">Shift</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3 text-end">Total Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr style="border-bottom: 1px solid #ccc;">
                                    <td class="py-3"><?php echo e($staff->name); ?></td>
                                    <td class="py-3 text-secondary">Pagi</td>
                                    <td class="py-3 text-secondary">Selesai</td>
                                    <td class="py-3 text-end fw-bold"><?php echo e($staff->orders_count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3">No data available</td>
                                </tr>
                            <?php endif; ?>
                            <!-- Dummy Rows to fill table -->
                            <tr style="border-bottom: 1px solid #ccc;">
                                <td class="py-3">Veny Etika</td>
                                <td class="py-3 text-secondary">Malam</td>
                                <td class="py-3 text-secondary">Bertugas</td>
                                <td class="py-3 text-end fw-bold">12</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bottom Section (Top Staff Banner) -->
            <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #B0A695; color: #4A4A35;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <i class="bi bi-graph-up-arrow fs-3"></i>
                    <h4 class="fw-bold m-0">Top Staff Bulanan</h4>
                </div>
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center gap-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"><i class="bi bi-person fw-bold fs-4"></i></div>
                        <div>
                            <div class="fw-bold">Staff 1</div>
                            <div class="small">522 Order</div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center gap-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"><i class="bi bi-person fw-bold fs-4"></i></div>
                        <div>
                            <div class="fw-bold">Staff 2</div>
                            <div class="small">512 Order</div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center gap-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;"><i class="bi bi-person fw-bold fs-4"></i></div>
                        <div>
                            <div class="fw-bold">Staff 3</div>
                            <div class="small">416 Order</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Stats Cards -->
        <div class="col-lg-4">
            <!-- Date Picker Dummy-->
            <!-- Date Picker Form -->
            <form action="<?php echo e(route(auth()->user()->role . '.dashboard')); ?>" method="GET" class="mb-4">
                <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white">
                    <span class="input-group-text border-0 bg-white ps-4 text-secondary"><i
                            class="bi bi-calendar"></i></span>
                    <input type="date" name="date" class="form-control border-0 text-secondary fw-bold"
                        value="<?php echo e(isset($today) ? $today->format('Y-m-d') : date('Y-m-d')); ?>" onchange="this.form.submit()"
                        style="outline: none; box-shadow: none;">
                </div>
            </form>

            <div class="d-flex flex-column gap-3">
                <!-- Sales Daily -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #EAE5D9;">
                    <h6 class="text-secondary fw-bold mb-2">Total Penjualan Harian</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">$</div>
                        <h3 class="fw-bold m-0">Rp<?php echo e(number_format($totalSalesToday, 0, ',', '.')); ?></h3>
                    </div>
                </div>

                <!-- Sales Monthly -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #B0A695;">
                    <h6 class="text-dark fw-bold mb-2">Total Penjualan Bulanan</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">$</div>
                        <h3 class="fw-bold m-0">Rp<?php echo e(number_format($totalSalesMonth, 0, ',', '.')); ?></h3>
                    </div>
                </div>

                <!-- Orders Daily -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #EAE5D9;">
                    <h6 class="text-secondary fw-bold mb-2">Total Orderan Harian</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;"><i class="bi bi-receipt"></i></div>
                        <h3 class="fw-bold m-0"><?php echo e($totalOrdersToday); ?></h3>
                    </div>
                </div>

                <!-- Orders Monthly -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #B0A695;">
                    <h6 class="text-dark fw-bold mb-2">Total Orderan Bulanan</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;"><i class="bi bi-receipt"></i></div>
                        <h3 class="fw-bold m-0"><?php echo e($totalOrdersMonth); ?></h3>
                    </div>
                </div>

                <!-- Refund Daily -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #EAE5D9;">
                    <h6 class="text-secondary fw-bold mb-2">Total Refund Harian</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;"><i class="bi bi-arrow-return-left"></i></div>
                        <h3 class="fw-bold m-0">Rp<?php echo e(number_format($totalRefundsToday, 0, ',', '.')); ?></h3>
                    </div>
                </div>

                <!-- Refund Monthly -->
                <div class="card border-0 rounded-4 shadow-sm p-4" style="background-color: #B0A695;">
                    <h6 class="text-dark fw-bold mb-2">Total Refund Bulanan</h6>
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;"><i class="bi bi-arrow-return-left"></i></div>
                        <h3 class="fw-bold m-0">Rp<?php echo e(number_format($totalRefundsMonth, 0, ',', '.')); ?></h3>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dailySalesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartLabels); ?>,
                datasets: [{
                    label: 'Orderan',
                    data: <?php echo json_encode($chartData); ?>,
                    borderColor: '#3E3C38',
                    backgroundColor: 'rgba(62, 60, 56, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 0
                }]
            },
            options: {
                animation: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: { color: '#BDAFA1', borderDash: [5, 5] },
                        ticks: { stepSize: 20 }
                    },
                    x: { grid: { display: false } }
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/azkaihza/tubes-kasir-resto/resources/views/manager/dashboard.blade.php ENDPATH**/ ?>