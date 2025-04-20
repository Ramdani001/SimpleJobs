<div class="container mt-5">
    <h2 class="mb-4">Dashboard Report</h2>

    <form method="GET" action="{{ route('report.index') }}" class="row mb-4">
        <div class="col-md-4 mb-2">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-4 mb-2">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
        </div>
    </form>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text fs-4">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Inventaris</h5>
                    <p class="card-text fs-4">{{ $totalInventaris }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk per Tipe</h5>
                    <canvas id="productTypeChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Perbandingan Produk & Inventaris</h5>
                    <canvas id="inventoryChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kondisi Inventaris</h5>
                    <canvas id="conditionChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
    const inventoryChart = new Chart(inventoryCtx, {
        type: 'pie',
        data: {
            labels: ['Produk', 'Inventaris'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $totalProducts }}, {{ $totalInventaris }}],
                backgroundColor: ['#4CAF50', '#2196F3']
            }]
        }
    });

    const productTypeCtx = document.getElementById('productTypeChart').getContext('2d');
    const productTypeChart = new Chart(productTypeCtx, {
        type: 'bar',
        data: {
            labels: @json($productTypes),
            datasets: [{
                label: 'Produk per Tipe',
                data: @json($productCounts),
                backgroundColor: '#FF5733',
                borderColor: '#FF5733',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const conditionCtx = document.getElementById('conditionChart').getContext('2d');
    const conditionChart = new Chart(conditionCtx, {
        type: 'pie',
        data: {
            labels: ['Bagus', 'Rusak'],
            datasets: [{
                label: 'Kondisi Inventaris',
                data: [{{ $goodCondition }}, {{ $damagedCondition }}],
                backgroundColor: ['#4CAF50', '#FF7043']
            }]
        }
    });
</script>
