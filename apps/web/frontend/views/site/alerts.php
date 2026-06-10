<?php
/** @var yii\web\View $this */
$this->title = 'Alerts & Logs';
?>
<div style="display: flex; flex-direction: column; gap: var(--space-5);">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="text-h2">System Alerts</h1>
        <button class="text-body-lg" style="color: var(--primary-600); background: none; border: none; cursor: pointer; font-weight: 500;">Mark all as read</button>
    </div>

    <!-- Filter Tabs -->
    <div style="display: flex; gap: var(--space-2); border-bottom: 1px solid var(--gray-200); padding-bottom: var(--space-2);">
        <button style="background: var(--primary-50); color: var(--primary-700); padding: var(--space-2) var(--space-4); border-radius: var(--radius-full); border: none; font-weight: 500; cursor: pointer;">All</button>
        <button style="background: transparent; color: var(--gray-500); padding: var(--space-2) var(--space-4); border-radius: var(--radius-full); border: none; font-weight: 500; cursor: pointer;">Warnings</button>
        <button style="background: transparent; color: var(--gray-500); padding: var(--space-2) var(--space-4); border-radius: var(--radius-full); border: none; font-weight: 500; cursor: pointer;">Information</button>
    </div>

    <!-- Alerts List -->
    <div style="background: white; border-radius: var(--radius-md); box-shadow: var(--elevation-1); display: flex; flex-direction: column;">
        <!-- Item 1 (Unread Warning) -->
        <div style="padding: var(--space-4) var(--space-5); border-bottom: 1px solid var(--gray-100); display: flex; gap: var(--space-4); align-items: flex-start; background-color: var(--warning-subtle);">
            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--warning-light); color: var(--warning); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; justify-content: space-between;">
                    <p class="text-body-lg" style="font-weight: 600;">Low Soil Moisture Detected</p>
                    <p class="text-caption" style="color: var(--gray-500);">10 mins ago</p>
                </div>
                <p class="text-body" style="color: var(--gray-600); margin-top: var(--space-1);">Sensor 1 reading dropped to 42%, which is below the threshold of 45%.</p>
            </div>
        </div>

        <!-- Item 2 (Read Info) -->
        <div style="padding: var(--space-4) var(--space-5); border-bottom: 1px solid var(--gray-100); display: flex; gap: var(--space-4); align-items: flex-start;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--info-light); color: var(--info); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; justify-content: space-between;">
                    <p class="text-body-lg" style="font-weight: 600;">System Restart</p>
                    <p class="text-caption" style="color: var(--gray-500);">2 hours ago</p>
                </div>
                <p class="text-body" style="color: var(--gray-600); margin-top: var(--space-1);">Gateway device initiated a scheduled reboot and came back online successfully.</p>
            </div>
        </div>

        <!-- Item 3 (Read Success) -->
        <div style="padding: var(--space-4) var(--space-5); display: flex; gap: var(--space-4); align-items: flex-start;">
            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--primary-100); color: var(--primary-600); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div style="flex: 1;">
                <div style="display: flex; justify-content: space-between;">
                    <p class="text-body-lg" style="font-weight: 600;">Irrigation Completed</p>
                    <p class="text-caption" style="color: var(--gray-500);">Yesterday</p>
                </div>
                <p class="text-body" style="color: var(--gray-600); margin-top: var(--space-1);">Morning watering schedule executed successfully. 15 Liters of water distributed.</p>
            </div>
        </div>
    </div>
</div>
