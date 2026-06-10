<?php
/** @var yii\web\View $this */

$this->title = 'Dashboard';

// API Configuration for frontend
$this->registerJsVar('apiBaseUrl', 'http://localhost:8000/api');

// Dashboard specific scripts
$this->registerJsFile('@web/js/isurf-api.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<!-- Minimalist Industrial Design Dashboard -->
<div style="display: flex; flex-direction: column; gap: var(--space-5);">
    
    <!-- Header with System Status -->
    <div style="display: flex; flex-direction: column; gap: var(--space-3); padding: var(--space-5); background: white; border-radius: var(--radius-md); box-shadow: var(--elevation-1); @media(min-width: 640px){ flex-direction: row; justify-content: space-between; align-items: center; }">
        <div>
            <h1 class="text-h2">Greenhouse Alpha</h1>
            <p class="text-body" style="color: var(--gray-600); margin-top: var(--space-1);">Live monitoring & control center</p>
        </div>
        <div style="display: flex; align-items: center; background-color: var(--primary-50); color: var(--primary-700); padding: var(--space-2) var(--space-4); border-radius: var(--radius-sm); border: 1px solid var(--primary-100);">
            <span style="position: relative; display: flex; width: 12px; height: 12px; margin-right: var(--space-3);">
              <span style="animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite; position: absolute; width: 100%; height: 100%; border-radius: 50%; background-color: var(--primary-500); opacity: 0.75;"></span>
              <span style="position: relative; display: inline-flex; border-radius: 50%; width: 12px; height: 12px; background-color: var(--primary-600);"></span>
            </span>
            <span class="text-body-lg" style="font-weight: 600;">System Online</span>
            <span style="margin: 0 var(--space-2); color: var(--primary-500);">|</span>
            <span class="text-caption" id="last-updated">Updating...</span>
        </div>
    </div>

    <!-- Metric Cards (4 Columns) -->
    <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: var(--space-5); @media(min-width: 640px){ grid-template-columns: repeat(2, 1fr); } @media(min-width: 1024px){ grid-template-columns: repeat(4, 1fr); }">
        
        <!-- Soil Moisture Card -->
        <div class="ds-sensor-card group">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Soil Moisture</p>
                    <div style="margin-top: var(--space-2); display: flex; align-items: baseline;">
                        <span class="text-display" id="metric-moisture">--</span>
                        <span class="text-h3" style="color: var(--gray-400); margin-left: var(--space-1);">%</span>
                    </div>
                </div>
                <div style="padding: var(--space-3); background-color: #EFF6FF; border-radius: var(--radius-sm); color: var(--chart-moisture);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
            <div style="margin-top: var(--space-4);">
                <span class="ds-badge ds-badge-success" id="status-moisture">Normal</span>
            </div>
        </div>

        <!-- Temperature Card -->
        <div class="ds-sensor-card group">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Air Temp</p>
                    <div style="margin-top: var(--space-2); display: flex; align-items: baseline;">
                        <span class="text-display" id="metric-temp">--</span>
                        <span class="text-h3" style="color: var(--gray-400); margin-left: var(--space-1);">°C</span>
                    </div>
                </div>
                <div style="padding: var(--space-3); background-color: #FFF7ED; border-radius: var(--radius-sm); color: var(--chart-temperature);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <div style="margin-top: var(--space-4);">
                <span class="ds-badge ds-badge-success" id="status-temp">Optimal</span>
            </div>
        </div>

        <!-- Water Level Card -->
        <div class="ds-sensor-card group">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Tank Level</p>
                    <div style="margin-top: var(--space-2); display: flex; align-items: baseline;">
                        <span class="text-display" id="metric-water">--</span>
                        <span class="text-h3" style="color: var(--gray-400); margin-left: var(--space-1);">%</span>
                    </div>
                </div>
                <div style="padding: var(--space-3); background-color: var(--gray-100); border-radius: var(--radius-sm); color: var(--chart-water-tank);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
            <div style="margin-top: var(--space-4); width: 100%; background-color: var(--gray-100); border-radius: var(--radius-full); height: 8px;">
                <div style="background-color: var(--chart-water-tank); height: 8px; border-radius: var(--radius-full); width: 0%; transition: width 0.5s ease;" id="progress-water"></div>
            </div>
        </div>

        <!-- TDS/Quality Card -->
        <div class="ds-sensor-card group">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p class="text-caption" style="color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Water Quality</p>
                    <div style="margin-top: var(--space-2); display: flex; align-items: baseline;">
                        <span class="text-display" id="metric-tds">--</span>
                        <span class="text-h3" style="color: var(--gray-400); margin-left: var(--space-1);">ppm</span>
                    </div>
                </div>
                <div style="padding: var(--space-3); background-color: #ECFEFF; border-radius: var(--radius-sm); color: var(--chart-humidity);">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
            <div style="margin-top: var(--space-4);">
                <span class="ds-badge ds-badge-success" id="status-tds">Optimal</span>
            </div>
        </div>
    </div>

    <!-- Charts & Controls Row -->
    <div style="display: grid; grid-template-columns: 1fr; gap: var(--space-5); @media(min-width: 1024px){ grid-template-columns: 2fr 1fr; }">
        
        <!-- Main Chart -->
        <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                <h3 class="text-h3">Moisture & Temperature Trend</h3>
                <select style="background: var(--gray-50); border: 1px solid var(--gray-200); color: var(--gray-600); padding: var(--space-2); border-radius: var(--radius-sm); outline: none;">
                    <option>Last 24 Hours</option>
                    <option>Last 7 Days</option>
                </select>
            </div>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <!-- Right Column: Controls & Alerts -->
        <div style="display: flex; flex-direction: column; gap: var(--space-5);">
            
            <?php if (!Yii::$app->user->isGuest): ?>
            <!-- Quick Control (Only for logged-in users) -->
            <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
                <h3 class="text-h3" style="margin-bottom: var(--space-4);">Irrigation Control</h3>
                
                <div style="padding: var(--space-4); border: 1px solid var(--gray-200); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: space-between; margin-bottom: var(--space-4);">
                    <div>
                        <p class="text-body-lg" style="font-weight: 600;">Main Valve</p>
                        <p class="text-body" style="color: var(--gray-400);" id="valve-status-text">Currently OFF</p>
                    </div>
                    
                    <!-- Custom Toggle Switch using JS -->
                    <button id="valve-toggle" style="position: relative; display: inline-flex; height: 32px; width: 56px; align-items: center; border-radius: var(--radius-full); background-color: var(--gray-200); border: none; cursor: pointer; transition: background-color 0.2s;">
                        <span id="valve-knob" style="display: inline-block; height: 24px; width: 24px; background-color: white; border-radius: 50%; transform: translateX(4px); transition: transform 0.2s; box-shadow: var(--elevation-1);"></span>
                    </button>
                </div>
                
                <a href="<?= yii\helpers\Url::to(['site/irrigation']) ?>" style="display: block; width: 100%; text-align: center; padding: var(--space-2); text-decoration: none; color: var(--primary-600); background-color: var(--primary-50); border-radius: var(--radius-sm); font-weight: 500;">
                    View full schedule &rarr;
                </a>
            </div>
            <?php endif; ?>

            <!-- Recent Alerts -->
            <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                    <h3 class="text-h3">Recent Alerts</h3>
                    <span class="ds-badge ds-badge-danger" id="alert-badge">0</span>
                </div>
                
                <div id="alert-list" style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <!-- Alerts will be populated via JS -->
                    <div style="display: flex; align-items: center; gap: var(--space-3); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;">
                        <div style="width: 40px; height: 40px; background-color: var(--gray-200); border-radius: 50%;"></div>
                        <div style="flex: 1;">
                            <div style="height: 8px; background-color: var(--gray-200); border-radius: 4px; margin-bottom: var(--space-2);"></div>
                            <div style="height: 8px; background-color: var(--gray-200); border-radius: 4px; width: 80%;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<style>
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: .5; }
}
@keyframes ping {
  75%, 100% { transform: scale(2); opacity: 0; }
}
@media (min-width: 640px) {
    div[style*="grid-template-columns: repeat(1, 1fr)"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}
@media (min-width: 1024px) {
    div[style*="grid-template-columns: repeat(1, 1fr)"] {
        grid-template-columns: repeat(4, 1fr) !important;
    }
    div[style*="grid-template-columns: 1fr"] {
        grid-template-columns: 2fr 1fr !important;
    }
}
</style>
