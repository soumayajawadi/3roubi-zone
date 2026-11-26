@extends('layouts.admin')

@section('content')
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
            <h3 class="fw-bold mb-0">{{ number_format($totalSales, 2) }} €</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card blue">
            <h6 class="text-white-50">Commandes</h6>
            <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card orange">
            <h6 class="text-white-50">En Attente</h6>
            <h3 class="fw-bold mb-0">{{ $pendingOrders }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card green">
            <h6 class="text-white-50">Produits en stock</h6>
            <h3 class="fw-bold mb-0">{{ \App\Models\Product::count() }}</h3>
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
                @forelse($lowStock as $p)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        {{ $p->name }}
                        <span class="badge bg-danger rounded-pill">{{ $p->stock }}</span>
                    </li>
                @empty
                    <li class="list-group-item px-0 text-muted">Aucun produit en stock faible.</li>
                @endforelse
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
            @foreach($topProducts as $tp)
                <tr><td>{{ $tp->product->name }}</td><td>{{ $tp->total_qty }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- HNA EL FIX: Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesData = @json($salesData);
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
@endsection