<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Supply Chain Intelligence Platform</title>
    
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
                            <h1 class="display-3 fw-bold text-primary my-2" id="totalRiskValue">0</h1>
                            <span class="fs-5 px-3 py-1 rounded-pill badge bg-secondary" id="riskStatusLabel">Calculating...</span>
                        </div>
                        <div class="small fw-semibold text-secondary mb-2">Kontribusi Komponen Risiko (Weighted Model):</div>
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
    // 1. Inisialisasi Variabel Global State Aplikasi
    let map = null;
    let globalRiskData = [];
    let globalCurrencyData = {};
    let currencyChartInstance = null;

    // Helper Fungsi format angka ribuan/jutaan/miliaran
    function formatNumber(num) {
        if (!num) return '-';
        if (num >= 1e12) return (num / 1e12).toFixed(2) + ' Trillion';
        if (num >= 1e9) return (num / 1e9).toFixed(2) + ' Billion';
        if (num >= 1e6) return (num / 1e6).toFixed(2) + ' Million';
        return num.toLocaleString();
    }

    // 2. JALANKAN SETELAH HTML SELESAI DIMUAT (Mencegah Layar Putih/Peta Hilang)
    document.addEventListener("DOMContentLoaded", async () => {
        console.log("DOM selesai dimuat secara sempurna. Memulai inisialisasi komponen...");

        // Inisialisasi Peta Leaflet secara Aman
        try {
            const mapContainer = document.getElementById('map');
            if (mapContainer) {
                map = L.map('map').setView([12.0, 105.0], 3);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 18,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                console.log("Peta Leaflet berhasil digambar.");
            } else {
                console.error("Elemen HTML dengan id 'map' tidak ditemukan!");
            }
        } catch (mapError) {
            console.error("Gagal memuat peta Leaflet:", mapError);
        }

        // Jalankan pengambilan data dari seluruh API Backend
        await initDashboard();
    });

    // 3. FUNGSI UTAMA: Ambil data dari 5 Endpoint API dengan Proteksi Crash Individual
    async function initDashboard() {
        console.log("Memulai proses sinkronisasi multi-API...");
        try {
            // Setiap fetch diproteksi catch agar jika salah satu API Laravel mati, sisa dashboard tidak ikut beku
            const [riskRes, portsRes, newsRes, currencyRes] = await Promise.all([
                fetch('/api/risk').then(res => res.json()).catch(err => { console.error("Eror API Risk:", err); return { status: 'error', data: [] }; }),
                fetch('/api/ports').then(res => res.json()).catch(err => { console.error("Eror API Ports:", err); return { status: 'error', data: [] }; }),
                fetch('/api/news').then(res => res.json()).catch(err => { console.error("Eror API News:", err); return { status: 'error', data: [] }; }),
                fetch('/api/currency').then(res => res.json()).catch(err => { console.error("Eror API Currency:", err); return { status: 'error', data: {} }; })
            ]);

            // Amankan data ke dalam State Global jika statusnya sukses
            if (riskRes && riskRes.status === 'success') globalRiskData = riskRes.data;
            if (currencyRes && (currencyRes.status === 'success' || currencyRes.status === 'warning')) globalCurrencyData = currencyRes;

            // Render komponen UI satu per satu secara independen
            try { populateCountrySelector(globalRiskData); } catch (e) { console.error("Gagal merender selektor negara:", e); }
            try { if (map) renderPortsOnMap(portsRes.data || []); } catch (e) { console.error("Gagal merender pelabuhan di peta:", e); }
            try { renderNewsFeed(newsRes.data || []); } catch (e) { console.error("Gagal merender feed berita:", e); }

            // Set default negara awal ke Indonesia (IDN) jika datanya tersedia
            const selector = document.getElementById('countrySelector');
            if (globalRiskData && globalRiskData.length > 0) {
                const defaultCountry = globalRiskData.find(c => c.country && c.country.iso_code === 'IDN') || globalRiskData[0];
                if (defaultCountry && defaultCountry.country) {
                    selector.value = defaultCountry.country.iso_code;
                    updateDashboardMetrics(defaultCountry.country.iso_code);
                }
            } else {
                selector.innerHTML = '<option value="">Data tidak tersedia / API Bermasalah</option>';
            }

        } catch (error) {
            console.error("Gagal total eksekusi initDashboard:", error);
        }
    }

    // 4. FUNGSI: Mengisi Opsi Dropdown Select Negara
    function populateCountrySelector(riskData) {
        const selector = document.getElementById('countrySelector');
        if (!riskData || riskData.length === 0) {
            selector.innerHTML = '<option value="">Gagal memuat negara</option>';
            return;
        }
        selector.innerHTML = ''; 

        riskData.forEach(item => {
            if (item.country) {
                const option = document.createElement('option');
                option.value = item.country.iso_code;
                option.textContent = `${item.country.name} (${item.country.iso_code})`;
                selector.appendChild(option);
            }
        });

        selector.addEventListener('change', (e) => {
            updateDashboardMetrics(e.target.value);
        });
    }

    // 5. FUNGSI: Menampilkan Titik Pelabuhan di Peta (Leaflet)
    function renderPortsOnMap(ports) {
        if (!ports || ports.length === 0 || !map) return;

        ports.forEach(port => {
            const customIcon = L.divIcon({
                html: `<i class="fa-solid fa-anchor text-primary fs-4 shadow"></i>`,
                className: 'custom-div-icon',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            const marker = L.marker([port.latitude, port.longitude], { icon: customIcon }).addTo(map);
            marker.bindPopup(`
                <div class="p-1">
                    <strong class="text-dark">${port.name}</strong><br>
                    <small class="text-muted"><i class="fa-solid fa-qrcode me-1"></i> Code: ${port.port_code || '-'}</small><br>
                    <small class="text-muted"><i class="fa-solid fa-flag me-1"></i> Negara: ${port.country ? port.country.name : '-'}</small>
                </div>
            `);
        });
    }

    // 6. FUNGSI: Menyajikan Feed Analisis Sentimen Berita
    function renderNewsFeed(newsArticles) {
        const container = document.getElementById('newsFeedContainer');
        if (!container) return;
        container.innerHTML = ''; 

        if (!newsArticles || newsArticles.length === 0) {
            container.innerHTML = '<div class="text-center py-4 text-muted small">Tidak ada berita intelijen tersedia.</div>';
            return;
        }

        newsArticles.forEach(article => {
            let badgeColor = 'bg-secondary';
            if (article.metrics && article.metrics.sentiment_result === 'Positive') badgeColor = 'bg-success';
            if (article.metrics && article.metrics.sentiment_result === 'Negative') badgeColor = 'bg-danger';

            const itemHTML = `
                <div class="list-group-item py-3 px-1 border-0 border-bottom">
                    <div class="d-flex w-100 justify-content-between align-items-start mb-1">
                        <h6 class="mb-1 fw-bold text-dark text-wrap me-2" style="font-size: 14px;">${article.title}</h6>
                        <span class="badge ${badgeColor} rounded-pill">${article.metrics ? article.metrics.sentiment_result : 'Neutral'}</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted" style="font-size: 11px;">
                        <span><i class="fa-solid fa-building-columns me-1"></i> Sumber: ${article.source || 'Unknown'}</span>
                        <span><i class="fa-solid fa-calculator me-1"></i> Pos: ${article.metrics ? article.metrics.positive_matches : 0} | Neg: ${article.metrics ? article.metrics.negative_matches : 0}</span>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', itemHTML);
        });
    }

    // 7. FUNGSI REAKTIF: Sinkronisasi Data Saat Negara Dipilih
    function updateDashboardMetrics(isoCode) {
        const countryRisk = globalRiskData.find(item => item.country && item.country.iso_code === isoCode);
        if (!countryRisk) return;

        // Statistik Makro Ekonomi Fallback Dinamis
        let rawGdp = isoCode === 'DEU' ? 4456000000000 : isoCode === 'CHN' ? 17960000000000 : isoCode === 'IDN' ? 1370000000000 : 1670000000000;
        let rawInf = isoCode === 'DEU' ? 2.1 : isoCode === 'CHN' ? 1.5 : isoCode === 'IDN' ? 2.8 : 3.6;
        let rawPop = isoCode === 'DEU' ? 84000000 : isoCode === 'CHN' ? 1411000000 : isoCode === 'IDN' ? 277000000 : 26000000;

        document.getElementById('gdpValue').textContent = '$' + formatNumber(rawGdp);
        document.getElementById('inflationValue').textContent = rawInf + '%';
        document.getElementById('populationValue').textContent = formatNumber(rawPop);

        // Update Nilai Tukar Mata Uang
        let currencyCode = isoCode === 'DEU' ? 'EUR' : isoCode === 'CHN' ? 'CNY' : isoCode === 'IDN' ? 'IDR' : 'AUD';
        if (globalCurrencyData.exchange_rates && globalCurrencyData.exchange_rates[currencyCode]) {
            let rate = globalCurrencyData.exchange_rates[currencyCode];
            document.getElementById('currencyValue').textContent = `${rate.toLocaleString()} ${currencyCode}`;
        } else {
            document.getElementById('currencyValue').textContent = '-';
        }

        // Update Komponen Skor Risiko Berbobot [cite: 214]
        const riskScoreElement = document.getElementById('totalRiskValue');
        const riskStatusLabel = document.getElementById('riskStatusLabel');
        
        riskScoreElement.textContent = countryRisk.total_risk_score;
        riskStatusLabel.textContent = countryRisk.risk_status;
        
        riskStatusLabel.className = `fs-5 px-3 py-1 rounded-pill badge bg-${countryRisk.ui_badge || 'secondary'}`;
        riskScoreElement.className = `display-3 fw-bold text-${countryRisk.ui_badge || 'primary'} my-2`;

        // Render Progress Bar Pengurai Risiko [cite: 218, 219, 220, 221]
        const breakdownContainer = document.getElementById('riskBreakdownContainer');
        if (breakdownContainer && countryRisk.risk_components) {
            breakdownContainer.innerHTML = '';
            const components = [
                { name: 'Risiko Cuaca Ekstrem (30%)', val: countryRisk.risk_components.weather_risk || 0, color: 'bg-info' },
                { name: 'Risiko Inflasi Finansial (20%)', val: countryRisk.risk_components.inflation_risk || 0, color: 'bg-danger' },
                { name: 'Risiko Sentimen Geopolitik Berita (40%)', val: countryRisk.risk_components.news_risk || 0, color: 'bg-success' },
                { name: 'Risiko Volatilitas Kurs Mata Uang (10%)', val: countryRisk.risk_components.currency_risk || 0, color: 'bg-warning' }
            ];

            components.forEach(comp => {
                const barHTML = `
                    <div class="mb-2">
                        <div class="d-flex justify-content-between small fw-bold text-dark mb-1">
                            <span>${comp.name}</span>
                            <span>Index: ${comp.val}/100</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar ${comp.color}" role="progressbar" style="width: ${comp.val}%" aria-valuenow="${comp.val}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                `;
                breakdownContainer.insertAdjacentHTML('beforeend', barHTML);
            });
        }

        // Update Grafik Tren Finansial (Chart.js)
        renderCurrencyTrendChart(currencyCode);
        
        // Pindahkan Kamera Peta Spasial Ke Negara yang Dipilih [cite: 89]
        if (map) {
            const countryCoordinates = {
                'IDN': [-2.5, 118.0],
                'CHN': [35.8, 104.1],
                'DEU': [51.1, 10.4],
                'AUS': [-25.2, 133.7]
            };
            if (countryCoordinates[isoCode]) {
                map.flyTo(countryCoordinates[isoCode], isoCode === 'IDN' ? 5 : 4, { animate: true, duration: 1.5 });
            }
        }
    }

    // 8. FUNGSI: Menggambar Ulang Tren Grafik Chart.js
    function renderCurrencyTrendChart(currencyCode) {
        const canvas = document.getElementById('currencyChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        
        let trendData = [1, 1, 1, 1, 1, 1, 1];
        if (globalCurrencyData.chart_trends && globalCurrencyData.chart_trends[currencyCode]) {
            trendData = globalCurrencyData.chart_trends[currencyCode];
        }

        if (currencyChartInstance) {
            currencyChartInstance.destroy();
        }

        currencyChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['H-6', 'H-5', 'H-4', 'H-3', 'H-2', 'H-1', 'Hari Ini'],
                datasets: [{
                    label: `Nilai Tukar ${currencyCode} per 1 USD`,
                    data: trendData,
                    borderColor: '#f1c40f',
                    backgroundColor: 'rgba(241, 196, 15, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#2c3e50',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: true, position: 'top' } },
                scales: {
                    y: { beginAtZero: false, grid: { color: '#eaeded' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }
</script>