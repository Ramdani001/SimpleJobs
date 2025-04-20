<div class="container mt-5">
    <h2 class="mb-4">Dashboard Report</h2>

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
