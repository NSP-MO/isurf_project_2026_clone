<?php
/** @var yii\web\View $this */
$this->title = 'Monitoring';
?>
<!-- Monitoring Page (Data Real-time) -->
<div class="monitoring-page">
    <div class="monitoring-header">
        <h1 class="text-h2">Real-time Monitoring</h1>
        <a href="<?= yii\helpers\Url::to(['site/request-data']) ?>" class="ds-btn-primary" style="text-decoration: none;">Download Data</a>
    </div>

    <!-- Gauge Charts Row -->
    <div class="gauge-grid">
        <div class="gauge-card">
            <div class="gauge-card-header">
                <h3 class="text-body-lg" style="font-weight: 600; margin: 0;">Water Tank</h3>
                <span class="ds-badge ds-badge-success">Normal</span>
            </div>
            <div class="gauge-body">
                <div class="gauge-canvas-wrap">
                    <canvas id="gaugeWater"></canvas>
                </div>
                <div class="gauge-value">
                    <span class="gauge-number">80</span>
                    <span class="gauge-unit">%</span>
                </div>
            </div>
        </div>

        <div class="gauge-card">
            <div class="gauge-card-header">
                <h3 class="text-body-lg" style="font-weight: 600; margin: 0;">pH Level</h3>
                <span class="ds-badge ds-badge-success">Optimal</span>
            </div>
            <div class="gauge-body">
                <div class="gauge-canvas-wrap">
                    <canvas id="gaugePH"></canvas>
                </div>
                <div class="gauge-value">
                    <span class="gauge-number">6.5</span>
                    <span class="gauge-unit">pH</span>
                </div>
            </div>
        </div>

        <div class="gauge-card">
            <div class="gauge-card-header">
                <h3 class="text-body-lg" style="font-weight: 600; margin: 0;">TDS</h3>
                <span class="ds-badge ds-badge-info">Good</span>
            </div>
            <div class="gauge-body">
                <div class="gauge-canvas-wrap">
                    <canvas id="gaugeTDS"></canvas>
                </div>
                <div class="gauge-value">
                    <span class="gauge-number">350</span>
                    <span class="gauge-unit">ppm</span>
                </div>
            </div>
        </div>

        <div class="gauge-card">
            <div class="gauge-card-header">
                <h3 class="text-body-lg" style="font-weight: 600; margin: 0;">Soil Moisture</h3>
                <span class="ds-badge ds-badge-success">Normal</span>
            </div>
            <div class="gauge-body">
                <div class="gauge-canvas-wrap">
                    <canvas id="gaugeMoisture"></canvas>
                </div>
                <div class="gauge-value">
                    <span class="gauge-number">65</span>
                    <span class="gauge-unit">%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
            <h3 class="text-h3" style="margin: 0;">Recent Readings</h3>
            <select style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: var(--space-2) var(--space-3); border-radius: var(--radius-sm); font-size: 13px; color: var(--gray-600);">
                <option>All Sensors</option>
                <option>Water Tank</option>
                <option>pH Level</option>
                <option>TDS</option>
            </select>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--gray-100);">
                        <th class="text-caption" style="padding: var(--space-3) var(--space-2); color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em;">Time</th>
                        <th class="text-caption" style="padding: var(--space-3) var(--space-2); color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em;">Sensor</th>
                        <th class="text-caption" style="padding: var(--space-3) var(--space-2); color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em;">Value</th>
                        <th class="text-caption" style="padding: var(--space-3) var(--space-2); color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                    </tr>
                </thead>
                <tbody id="readings-table">
                    <tr style="border-bottom: 1px solid var(--gray-100);">
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">10:05:00</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2); font-weight: 500;">Soil Moisture</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">65 %</td>
                        <td style="padding: var(--space-3) var(--space-2);"><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--gray-100);">
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">10:05:00</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2); font-weight: 500;">Air Temperature</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">24.5 °C</td>
                        <td style="padding: var(--space-3) var(--space-2);"><span class="ds-badge ds-badge-success">Optimal</span></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--gray-100);">
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">10:04:30</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2); font-weight: 500;">Water pH</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">6.5 pH</td>
                        <td style="padding: var(--space-3) var(--space-2);"><span class="ds-badge ds-badge-success">Optimal</span></td>
                    </tr>
                    <tr>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">10:04:30</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2); font-weight: 500;">TDS</td>
                        <td class="text-body" style="padding: var(--space-3) var(--space-2);">350 ppm</td>
                        <td style="padding: var(--space-3) var(--space-2);"><span class="ds-badge ds-badge-info">Good</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
    <!-- Admin-Only: Detailed Sensor Data Panel -->
    <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
        <div class="admin-data-header">
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <h3 class="text-h3" style="margin: 0;">Raw Sensor Data</h3>
                <span class="ds-badge" style="background-color: #FEE2E2; color: var(--danger); font-size: 11px;">Admin Only</span>
            </div>
            <div style="display: flex; gap: var(--space-2); align-items: center;">
                <select id="admin-device-filter" style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: var(--space-2) var(--space-3); border-radius: var(--radius-sm); font-size: 13px; color: var(--gray-600);">
                    <option value="all">All Devices</option>
                    <option value="1">GH-ALPHA-01</option>
                    <option value="2">GH-NURSERY-02</option>
                </select>
                <select id="admin-sensor-filter" style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: var(--space-2) var(--space-3); border-radius: var(--radius-sm); font-size: 13px; color: var(--gray-600);">
                    <option value="all">All Sensors</option>
                    <option value="moisture">Soil Moisture</option>
                    <option value="ph">pH</option>
                    <option value="tds">TDS</option>
                    <option value="temperature">Temperature</option>
                    <option value="ultrasonic">Water Level</option>
                </select>
                <button class="ds-btn-primary" style="font-size: 12px; padding: var(--space-2) var(--space-3);">
                    <svg class="w-4 h-4" style="display: inline-block; vertical-align: middle; margin-right: 4px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export CSV
                </button>
            </div>
        </div>

        <div style="overflow-x: auto; margin-top: var(--space-4);">
            <table class="admin-data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Timestamp</th>
                        <th>Device</th>
                        <th>Sensor</th>
                        <th>Type</th>
                        <th>Raw Value</th>
                        <th>Unit</th>
                        <th>Min Threshold</th>
                        <th>Max Threshold</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="admin-data-body">
                    <tr>
                        <td class="mono">1024</td>
                        <td class="mono">2026-06-10 10:05:12</td>
                        <td>GH-ALPHA-01</td>
                        <td>Soil Moisture Sensor</td>
                        <td><span class="type-tag type-moisture">moisture</span></td>
                        <td class="mono value-cell">65.20</td>
                        <td>%</td>
                        <td class="mono">40.0</td>
                        <td class="mono">85.0</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr>
                        <td class="mono">1023</td>
                        <td class="mono">2026-06-10 10:05:12</td>
                        <td>GH-ALPHA-01</td>
                        <td>Water pH Level</td>
                        <td><span class="type-tag type-ph">ph</span></td>
                        <td class="mono value-cell">6.52</td>
                        <td>pH</td>
                        <td class="mono">5.5</td>
                        <td class="mono">7.5</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr>
                        <td class="mono">1022</td>
                        <td class="mono">2026-06-10 10:05:12</td>
                        <td>GH-ALPHA-01</td>
                        <td>Water Quality (TDS)</td>
                        <td><span class="type-tag type-tds">tds</span></td>
                        <td class="mono value-cell">352.40</td>
                        <td>ppm</td>
                        <td class="mono">0.0</td>
                        <td class="mono">800.0</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr>
                        <td class="mono">1021</td>
                        <td class="mono">2026-06-10 10:05:10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Air Temperature</td>
                        <td><span class="type-tag type-temp">temperature</span></td>
                        <td class="mono value-cell">24.50</td>
                        <td>°C</td>
                        <td class="mono">15.0</td>
                        <td class="mono">35.0</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr>
                        <td class="mono">1020</td>
                        <td class="mono">2026-06-10 10:05:10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Water Tank Level</td>
                        <td><span class="type-tag type-ultrasonic">ultrasonic</span></td>
                        <td class="mono value-cell">80.00</td>
                        <td>%</td>
                        <td class="mono">20.0</td>
                        <td class="mono">100.0</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                    <tr class="row-warning">
                        <td class="mono">1019</td>
                        <td class="mono">2026-06-10 10:04:58</td>
                        <td>GH-NURSERY-02</td>
                        <td>Nursery Soil Moisture</td>
                        <td><span class="type-tag type-moisture">moisture</span></td>
                        <td class="mono value-cell" style="color: var(--warning); font-weight: 600;">42.10</td>
                        <td>%</td>
                        <td class="mono">50.0</td>
                        <td class="mono">90.0</td>
                        <td><span class="ds-badge ds-badge-warning">Below Min</span></td>
                    </tr>
                    <tr>
                        <td class="mono">1018</td>
                        <td class="mono">2026-06-10 10:04:58</td>
                        <td>GH-NURSERY-02</td>
                        <td>Nursery Temperature</td>
                        <td><span class="type-tag type-temp">temperature</span></td>
                        <td class="mono value-cell">25.80</td>
                        <td>°C</td>
                        <td class="mono">20.0</td>
                        <td class="mono">30.0</td>
                        <td><span class="ds-badge ds-badge-success">Normal</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="admin-pagination">
            <p class="text-caption" style="color: var(--gray-400); margin: 0;">Showing 1-7 of 1,024 records</p>
            <div style="display: flex; gap: var(--space-1);">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span class="text-caption" style="color: var(--gray-400); padding: 0 4px;">…</span>
                <button class="page-btn">147</button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.monitoring-page {
    display: flex;
    flex-direction: column;
    gap: var(--space-5);
}
.monitoring-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
/* Gauge Grid: 2 cols on mobile, 4 cols on desktop */
.gauge-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-4);
}
@media (min-width: 1024px) {
    .gauge-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}
.gauge-card {
    background: white;
    padding: var(--space-4);
    border-radius: var(--radius-md);
    box-shadow: var(--elevation-1);
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}
.gauge-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--elevation-2);
}
.gauge-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-3);
}
.gauge-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-1);
}
.gauge-canvas-wrap {
    width: 120px;
    height: 60px;
    position: relative;
}
@media (min-width: 768px) {
    .gauge-canvas-wrap {
        width: 140px;
        height: 70px;
    }
}
.gauge-value {
    display: flex;
    align-items: baseline;
    gap: 4px;
}
.gauge-number {
    font-size: 28px;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1;
}
.gauge-unit {
    font-size: 14px;
    font-weight: 500;
    color: var(--gray-400);
}

/* Admin Data Panel */
.admin-data-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-3);
}
.admin-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.admin-data-table thead th {
    padding: var(--space-2) var(--space-3);
    text-align: left;
    color: var(--gray-400);
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--gray-100);
    white-space: nowrap;
}
.admin-data-table tbody td {
    padding: var(--space-2) var(--space-3);
    border-bottom: 1px solid var(--gray-100);
    color: var(--gray-900);
    white-space: nowrap;
}
.admin-data-table tbody tr:hover {
    background-color: var(--gray-50);
}
.admin-data-table .mono {
    font-family: 'Courier New', monospace;
    font-size: 12px;
}
.admin-data-table .value-cell {
    font-weight: 600;
    color: var(--gray-900);
}
.admin-data-table .row-warning {
    background-color: #FFFBEB;
}
.admin-data-table .row-warning:hover {
    background-color: #FEF3C7;
}

/* Sensor Type Tags */
.type-tag {
    display: inline-block;
    padding: 2px 8px;
    border-radius: var(--radius-full);
    font-size: 11px;
    font-weight: 500;
}
.type-moisture { background: #DBEAFE; color: #1D4ED8; }
.type-ph { background: #F3E8FF; color: #7C3AED; }
.type-tds { background: #CFFAFE; color: #0E7490; }
.type-temp { background: #FFF7ED; color: #C2410C; }
.type-ultrasonic { background: #D1FAE5; color: #065F46; }

/* Pagination */
.admin-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-4);
    padding-top: var(--space-3);
    border-top: 1px solid var(--gray-100);
}
.page-btn {
    width: 32px;
    height: 32px;
    border: 1px solid var(--gray-200);
    background: white;
    border-radius: var(--radius-sm);
    font-size: 13px;
    color: var(--gray-600);
    cursor: pointer;
    transition: all 0.15s;
}
.page-btn:hover {
    background: var(--gray-50);
    border-color: var(--gray-400);
}
.page-btn.active {
    background: var(--primary-500);
    color: white;
    border-color: var(--primary-500);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const gaugeOptions = {
        rotation: -90,
        circumference: 180,
        cutout: '78%',
        responsive: true,
        maintainAspectRatio: false,
        plugins: { tooltip: {enabled: false}, legend: {display: false} }
    };

    new Chart(document.getElementById('gaugeWater'), {
        type: 'doughnut',
        data: { datasets: [{ data: [80, 20], backgroundColor: ['#22C55E', '#F1F5F9'], borderWidth: 0 }] },
        options: gaugeOptions
    });
    new Chart(document.getElementById('gaugePH'), {
        type: 'doughnut',
        data: { datasets: [{ data: [65, 35], backgroundColor: ['#3B82F6', '#F1F5F9'], borderWidth: 0 }] },
        options: gaugeOptions
    });
    new Chart(document.getElementById('gaugeTDS'), {
        type: 'doughnut',
        data: { datasets: [{ data: [35, 65], backgroundColor: ['#06B6D4', '#F1F5F9'], borderWidth: 0 }] },
        options: gaugeOptions
    });
    new Chart(document.getElementById('gaugeMoisture'), {
        type: 'doughnut',
        data: { datasets: [{ data: [65, 35], backgroundColor: ['#F97316', '#F1F5F9'], borderWidth: 0 }] },
        options: gaugeOptions
    });
});
</script>
