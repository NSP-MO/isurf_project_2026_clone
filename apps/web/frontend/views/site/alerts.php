<?php
/** @var yii\web\View $this */
$this->title = 'Alerts & Logs';
?>
<div style="display: flex; flex-direction: column; gap: var(--space-5);">
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 class="text-h2" style="font-weight: 700; color: var(--gray-900);">Critical Alerts & Logs</h1>
            <p class="text-body" style="color: var(--gray-500);">Log peringatan Offline perangkat dan Anomali sensor</p>
        </div>
        <button class="ds-btn-outline" style="font-weight: 500;">Tandai Semua Dibaca</button>
    </div>

    <!-- Alerts List -->
    <div style="background: white; border-radius: var(--radius-md); box-shadow: var(--elevation-1); display: flex; flex-direction: column; border: 1px solid var(--gray-200);">
        <div style="padding: 40px; text-align: center;">
            <svg class="w-8 h-8" style="margin: 0 auto 16px auto; color: var(--gray-400);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <p class="text-body" style="color: var(--gray-500); font-weight: 500;">Tidak ada log kritikal baru.</p>
        </div>
    </div>
</div>
