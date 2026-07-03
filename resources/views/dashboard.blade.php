<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain Intelligence Platform</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/box.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #2c3e50;
            color: white;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #34495e;
            color: #3498db;
        }
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card-custom:hover {
            transform: translateY(-3px);
        }
        #map {
            height: 450px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
            <div class="d-flex align-items-center mb-4 px-2">
                <i class="fa-solid fa-ship fa-xl text-info me-2"></i>
                <h5 class="m-0 fw-bold text-wrap text-info" style="font-size: 16px;">Logistics Intel</h5>
            </div>
            <hr class="text-secondary">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-earth-americas me-2"></i> Peta Risiko</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-anchor me-2"></i> Daftar Pelabuhan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-newspaper me-2"></i> Berita Sentimen</a>
                </li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
                <div>
                    <h1 class="h2 fw-bold text-dark">Global Supply Chain Risk Dashboard</h1>
                    <p class="text-secondary">Platform Pemantauan Multi-API & Analitik Data Real-time</p>
                </div>
                <div class="mb-2 mb-md-0">
                    <label for="countrySelector" class="form-label small fw-bold text-secondary text-uppercase m-0 d-block mb-1">Pilih Negara Pemantauan:</label>
                    <select class="form-select fw-semibold border-secondary-subtle shadow-sm" id="countrySelector" style="width: 220px;">
                        <option value="">Memuat data negara...</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-custom p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold text-muted mb-1">GDP Negara</p>
                                <h4 class="fw-bold m-0 text-dark" id="gdpValue">-</h4>
                            </div>
                            <div class="p-3 bg-primary-subtle text-primary rounded-circle"><i class="fa-solid fa-wallet fa-lg"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-custom p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold text-muted mb-1">Tingkat Inflasi</p>
                                <h4 class="fw-bold m-0 text-dark" id="inflationValue">-</h4>
                            </div>
                            <div class="p-3 bg-danger-subtle text-danger rounded-circle"><i class="fa-solid fa-arrow-trend-up fa-lg"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-custom p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold text-muted mb-1">Total Populasi</p>
                                <h4 class="fw-bold m-0 text-dark" id="populationValue">-</h4>
                            </div>
                            <div class="p-3 bg-success-subtle text-success rounded-circle"><i class="fa-solid fa-users fa-lg"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-custom p-3 bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold text-muted mb-1">Mata Uang (vs USD)</p>
                                <h4 class="fw-bold m-0 text-dark" id="currencyValue">-</h4>
                            </div>
                            <div class="p-3 bg-warning-subtle text-warning rounded-circle"><i class="fa-solid fa-coins fa-lg"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-8">
                    <div class="card card-custom p-3 bg-white h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-map-location-dot text-info me-2"></i> Geospatial Port & Weather Tracker</h5>
                            <span class="badge bg-secondary p-2 shadow-sm" id="weatherBadge">Weather: Normal</span>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-4">
                    <div class="card card-custom p-3 bg-white h-100">
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-shield-halved text-danger me-2"></i> Risk Scoring Prediction</h5>
                        <div class="text-center py-4 bg-light rounded mb-3">
                            <h6 class="text-uppercase small fw-bold text-secondary mb-1">Total Risk Score Index</h6>
                            <h1 class="display-3 fw-black text-primary my-2" id="totalRiskValue">0</h1>
                            <span class="fs-5 px-3 py-1 rounded-pill badge bg-secondary" id="riskStatusLabel">Calculating...</span>
                        </div>
                        <div class="small fw-semibold text-secondary mb-2">Kontribusi Komponen Risiko (Weighted Model)[cite: 214]:</div>
                        <div class="space-y-2" id="riskBreakdownContainer">
                            <p class="text-center text-muted small py-3">Pilih negara untuk melihat uraian...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card card-custom p-3 bg-white">
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-chart-line text-warning me-2"></i> Currency Trend Analysis (Chart.js)</h5>
                        <div style="position: relative; height:250px; width:100%">
                            <canvas id="currencyChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card card-custom p-3 bg-white h-100">
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-brain text-success me-2"></i> AI News Intelligence (Lexicon-Based)</h5>
                        <div class="list-group list-group-flush" id="newsFeedContainer">
                            <div class="text-center py-4 text-muted small">Memuat analisa berita terupdate...</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Inisialisasi Peta Leaflet secara global terpusat pada koordinat ekuator dunia 
    const map = L.map('map').setView([10.0, 110.0], 3);
    
    // Gunakan OpenStreetMap Base Layer Gratis [cite: 88, 89]
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    console.log("Struktur Kerangka Dashboard UI Berhasil Diinisialisasi!");
</script>

</body>
</html>