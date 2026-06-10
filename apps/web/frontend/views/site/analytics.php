<?php
/** @var yii\web\View $this */
$this->title = 'Analytics';
?>
<div class="analytics-page">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        <h1 class="text-h2" style="margin: 0;">Analytics & Reports</h1>
        <div style="display: flex; gap: var(--space-3); align-items: center; width: 100%; sm:width: auto;">
            <select class="analytics-select" style="flex: 1; sm:flex: none;">
                <option>Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>This Year</option>
            </select>
            <a href="<?= yii\helpers\Url::to(['site/request-data']) ?>" class="ds-btn-primary" style="text-decoration: none; white-space: nowrap;">Download Data</a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="ds-grid ds-grid-cols-1 md-grid-cols-2 lg-grid-cols-4">
        <div class="summary-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin: 0;">Avg. Moisture</p>
                    <p class="summary-value">58<span class="summary-unit">%</span></p>
                </div>
                <div style="padding: var(--space-2); background: #EFF6FF; border-radius: var(--radius-sm); color: var(--blue-500);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
            <div class="summary-trend trend-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                +2.4% from last week
            </div>
        </div>

        <div class="summary-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin: 0;">Water Used</p>
                    <p class="summary-value">342<span class="summary-unit">L</span></p>
                </div>
                <div style="padding: var(--space-2); background: #ECFEFF; border-radius: var(--radius-sm); color: var(--cyan-500);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <div class="summary-trend trend-down">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                +12L from last week
            </div>
        </div>

        <div class="summary-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin: 0;">Alerts</p>
                    <p class="summary-value">4</p>
                </div>
                <div style="padding: var(--space-2); background: #FEF3C7; border-radius: var(--radius-sm); color: var(--warning);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
            </div>
            <div class="summary-trend trend-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                -2 from last week
            </div>
        </div>

        <div class="summary-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin: 0;">Uptime</p>
                    <p class="summary-value">99.8<span class="summary-unit">%</span></p>
                </div>
                <div style="padding: var(--space-2); background: var(--primary-50); border-radius: var(--radius-sm); color: var(--primary-600);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="summary-trend trend-up">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                +0.1% from last week
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="ds-grid ds-grid-cols-1 lg-grid-cols-2-1">
        <!-- Water Consumption Bar Chart -->
        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="text-h3" style="margin: 0;">Water Consumption</h3>
                <span class="text-caption" style="color: var(--gray-400);">Liters per day</span>
            </div>
            <div style="position: relative; height: 280px; width: 100%;">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Sensor Comparison Radar Chart -->
        <div class="chart-card">
            <div class="chart-card-header">
                <h3 class="text-h3" style="margin: 0;">Sensor Health</h3>
                <span class="text-caption" style="color: var(--gray-400);">Normalized scores</span>
            </div>
            <div style="position: relative; height: 280px; width: 100%;">
                <canvas id="radarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Full Width Trend Chart -->
    <div class="chart-card">
        <div class="chart-card-header">
            <h3 class="text-h3" style="margin: 0;">7-Day Moisture & Temperature Trend</h3>
            <div style="display: flex; gap: var(--space-4); align-items: center;">
                <span style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-600);"><span style="width: 12px; height: 3px; background: var(--blue-500); border-radius: 2px; display: inline-block;"></span> Moisture</span>
                <span style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--gray-600);"><span style="width: 12px; height: 3px; background: var(--orange-500); border-radius: 2px; display: inline-block;"></span> Temperature</span>
            </div>
        </div>
        <div style="position: relative; height: 260px; width: 100%;">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin'): ?>
    <!-- Admin-Only: Aggregated Analytics Data -->
    <div class="chart-card">
        <div class="analytics-data-header">
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <h3 class="text-h3" style="margin: 0;">Aggregated Sensor Data</h3>
                <span class="ds-badge" style="background-color: #FEE2E2; color: var(--danger); font-size: 11px;">Admin Only</span>
            </div>
            <div style="display: flex; gap: var(--space-2); align-items: center; flex-wrap: wrap;">
                <select style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: var(--space-2) var(--space-3); border-radius: var(--radius-sm); font-size: 13px; color: var(--gray-600);">
                    <option>All Devices</option>
                    <option>GH-ALPHA-01</option>
                    <option>GH-NURSERY-02</option>
                </select>
                <select style="background: var(--gray-50); border: 1px solid var(--gray-200); padding: var(--space-2) var(--space-3); border-radius: var(--radius-sm); font-size: 13px; color: var(--gray-600);">
                    <option>Daily</option>
                    <option>Hourly</option>
                    <option>Weekly</option>
                </select>
                <button class="ds-btn-primary" style="font-size: 12px; padding: var(--space-2) var(--space-3);">
                    <svg style="display: inline-block; vertical-align: middle; margin-right: 4px; width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export CSV
                </button>
            </div>
        </div>

        <div style="overflow-x: auto; margin-top: var(--space-4);">
            <table class="analytics-data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Device</th>
                        <th>Sensor</th>
                        <th>Type</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Avg</th>
                        <th>Readings</th>
                        <th>Anomalies</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Soil Moisture</td>
                        <td><span class="a-type-tag a-type-moisture">moisture</span></td>
                        <td class="mono">52.3 %</td>
                        <td class="mono">72.1 %</td>
                        <td class="mono" style="font-weight: 600;">65.2 %</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Water pH</td>
                        <td><span class="a-type-tag a-type-ph">ph</span></td>
                        <td class="mono">6.1 pH</td>
                        <td class="mono">7.0 pH</td>
                        <td class="mono" style="font-weight: 600;">6.5 pH</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-ALPHA-01</td>
                        <td>TDS</td>
                        <td><span class="a-type-tag a-type-tds">tds</span></td>
                        <td class="mono">310 ppm</td>
                        <td class="mono">420 ppm</td>
                        <td class="mono" style="font-weight: 600;">352 ppm</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Temperature</td>
                        <td><span class="a-type-tag a-type-temp">temperature</span></td>
                        <td class="mono">21.0 °C</td>
                        <td class="mono">29.5 °C</td>
                        <td class="mono" style="font-weight: 600;">24.5 °C</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-ALPHA-01</td>
                        <td>Water Tank</td>
                        <td><span class="a-type-tag a-type-ultrasonic">ultrasonic</span></td>
                        <td class="mono">68.0 %</td>
                        <td class="mono">85.0 %</td>
                        <td class="mono" style="font-weight: 600;">80.0 %</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr class="a-row-warning">
                        <td class="mono">2026-06-10</td>
                        <td>GH-NURSERY-02</td>
                        <td>Soil Moisture</td>
                        <td><span class="a-type-tag a-type-moisture">moisture</span></td>
                        <td class="mono" style="color: var(--warning); font-weight: 600;">38.2 %</td>
                        <td class="mono">61.0 %</td>
                        <td class="mono" style="font-weight: 600;">42.1 %</td>
                        <td class="mono">144</td>
                        <td class="mono" style="color: var(--warning); font-weight: 600;">12</td>
                        <td><span class="ds-badge ds-badge-warning">Attention</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-10</td>
                        <td>GH-NURSERY-02</td>
                        <td>Temperature</td>
                        <td><span class="a-type-tag a-type-temp">temperature</span></td>
                        <td class="mono">22.0 °C</td>
                        <td class="mono">28.0 °C</td>
                        <td class="mono" style="font-weight: 600;">25.8 °C</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                    <tr>
                        <td class="mono">2026-06-09</td>
                        <td>GH-ALPHA-01</td>
                        <td>Soil Moisture</td>
                        <td><span class="a-type-tag a-type-moisture">moisture</span></td>
                        <td class="mono">55.1 %</td>
                        <td class="mono">74.3 %</td>
                        <td class="mono" style="font-weight: 600;">63.0 %</td>
                        <td class="mono">144</td>
                        <td class="mono">0</td>
                        <td><span class="ds-badge ds-badge-success">Healthy</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="analytics-pagination">
            <p class="text-caption" style="color: var(--gray-400); margin: 0;">Showing 1-8 of 56 aggregated records</p>
            <div style="display: flex; gap: var(--space-1);">
                <button class="a-page-btn active">1</button>
                <button class="a-page-btn">2</button>
                <button class="a-page-btn">3</button>
                <span class="text-caption" style="color: var(--gray-400); padding: 0 4px;">…</span>
                <button class="a-page-btn">8</button>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.analytics-page {
    display: flex;
    flex-direction: column;
    gap: var(--space-5);
}
.analytics-select {
    background: white;
    border: 1px solid var(--gray-200);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-sm);
    font-size: 14px;
    color: var(--gray-600);
    cursor: pointer;
}
.summary-card {
    background: white;
    padding: var(--space-4);
    border-radius: var(--radius-md);
    box-shadow: var(--elevation-1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: var(--space-3);
    transition: transform 0.2s, box-shadow 0.2s;
}
.summary-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--elevation-2);
}
.summary-value {
    font-size: 32px;
    font-weight: 700;
    color: var(--gray-900);
    margin: var(--space-2) 0 0 0;
    line-height: 1;
}
.summary-unit {
    font-size: 18px;
    font-weight: 500;
    color: var(--gray-400);
    margin-left: 2px;
}
.summary-trend {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 500;
}
.trend-up { color: var(--primary-600); }
.trend-down { color: var(--danger); }
/* Charts */
.chart-card {
    background: white;
    padding: var(--space-5);
    border-radius: var(--radius-md);
    box-shadow: var(--elevation-1);
}
.chart-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-4);
}
/* Admin Aggregated Data Table */
.analytics-data-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-3);
}
.analytics-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.analytics-data-table thead th {
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
.analytics-data-table tbody td {
    padding: var(--space-2) var(--space-3);
    border-bottom: 1px solid var(--gray-100);
    color: var(--gray-900);
    white-space: nowrap;
}
.analytics-data-table tbody tr:hover {
    background-color: var(--gray-50);
}
.analytics-data-table .mono {
    font-family: 'Courier New', monospace;
    font-size: 12px;
}
.a-row-warning {
    background-color: #FFFBEB;
}
.a-row-warning:hover {
    background-color: #FEF3C7 !important;
}
.a-type-tag {
    display: inline-block;
    padding: 2px 8px;
    border-radius: var(--radius-full);
    font-size: 11px;
    font-weight: 500;
}
.a-type-moisture { background: #DBEAFE; color: #1D4ED8; }
.a-type-ph { background: #F3E8FF; color: #7C3AED; }
.a-type-tds { background: #CFFAFE; color: #0E7490; }
.a-type-temp { background: #FFF7ED; color: #C2410C; }
.a-type-ultrasonic { background: #D1FAE5; color: #065F46; }
.analytics-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-4);
    padding-top: var(--space-3);
    border-top: 1px solid var(--gray-100);
}
.a-page-btn {
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
.a-page-btn:hover {
    background: var(--gray-50);
    border-color: var(--gray-400);
}
.a-page-btn.active {
    background: var(--primary-500);
    color: white;
    border-color: var(--primary-500);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartFont = { family: "'Inter', sans-serif" };
    const gridColor = '#F1F5F9';

    // Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Water (L)',
                data: [45, 52, 48, 50, 42, 55, 50],
                backgroundColor: '#22C55E',
                borderRadius: 6,
                borderSkipped: false,
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: chartFont, color: '#94A3B8' } },
                y: { grid: { color: gridColor }, ticks: { font: chartFont, color: '#94A3B8' }, border: { display: false } }
            }
        }
    });

    // Radar Chart
    new Chart(document.getElementById('radarChart'), {
        type: 'radar',
        data: {
            labels: ['Moisture', 'pH', 'TDS', 'Temp', 'Tank'],
            datasets: [{
                label: 'Current',
                data: [76, 87, 56, 70, 80],
                borderColor: '#22C55E',
                backgroundColor: 'rgba(34,197,94,0.15)',
                pointBackgroundColor: '#22C55E',
                borderWidth: 2,
            },{
                label: 'Ideal',
                data: [80, 90, 50, 75, 90],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                pointBackgroundColor: '#3B82F6',
                borderWidth: 2,
                borderDash: [4, 4],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: chartFont, color: '#475569', boxWidth: 12, padding: 16 }
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    grid: { color: gridColor },
                    angleLines: { color: gridColor },
                    pointLabels: { font: { ...chartFont, size: 11 }, color: '#475569' },
                    ticks: { display: false }
                }
            }
        }
    });

    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jun 4', 'Jun 5', 'Jun 6', 'Jun 7', 'Jun 8', 'Jun 9', 'Jun 10'],
            datasets: [{
                label: 'Moisture (%)',
                data: [62, 58, 65, 60, 55, 63, 58],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59,130,246,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 2,
            },{
                label: 'Temperature (°C)',
                data: [24, 26, 25, 28, 27, 24, 25],
                borderColor: '#F97316',
                backgroundColor: 'rgba(249,115,22,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: chartFont, color: '#94A3B8' } },
                y: { grid: { color: gridColor }, ticks: { font: chartFont, color: '#94A3B8' }, border: { display: false } }
            }
        }
    });
});
</script>
