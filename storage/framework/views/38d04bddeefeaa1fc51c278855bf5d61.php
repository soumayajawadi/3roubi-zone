

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark">Tableau de Bord</h2>
    <div class="d-flex align-items-center gap-2">
        <span class="fw-bold">Admin</span>
        <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
    </div>
</div>

<!-- Les cartes mte3 les stats -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card red">
            <h6 class="text-white-50">Ventes Totales</h6>
            <h3 class="fw-bold mb-0"><?php echo e(number_format($totalSales, 2)); ?> €</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card blue">
            <h6 class="text-white-50">Commandes</h6>
            <h3 class="fw-bold mb-0"><?php echo e($totalOrders); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card orange">
            <h6 class="text-white-50">En Attente</h6>
            <h3 class="fw-bold mb-0"><?php echo e($pendingOrders); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card green">
            <h6 class="text-white-50">Produits en stock</h6>
            <h3 class="fw-bold mb-0"><?php echo e(\App\Models\Product::count()); ?></h3>
        </div>
    </div>
</div>

<div class="row">
    <!-- Chart mte3 les ventes -->
    <div class="col-md-8">
        <div class="content-card">
            <h5 class="fw-bold mb-3">Ventes des 7 derniers jours</h5>
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>
    
    <!-- Stock Faible -->
    <div class="col-md-4">
        <div class="content-card">
            <h5 class="fw-bold text-danger mb-3">⚠️ Stock Faible</h5>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $lowStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <?php echo e($p->name); ?>

                        <span class="badge bg-danger rounded-pill"><?php echo e($p->stock); ?></span>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item px-0 text-muted">Aucun produit en stock faible.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<!-- Top 5 Produits -->
<div class="content-card mt-4">
    <h5 class="fw-bold mb-3">🔥 Top 5 Produits</h5>
    <table class="table">
        <thead><tr><th>Produit</th><th>Quantité Vendue</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr><td><?php echo e($tp->product->name); ?></td><td><?php echo e($tp->total_qty); ?></td></tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- HNA EL FIX: Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesData = <?php echo json_encode($salesData, 15, 512) ?>;
    const labels = salesData.map(d => d.date);
    const data = salesData.map(d => d.total);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventes (€)',
                data: data,
                borderColor: '#dc2626',
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>