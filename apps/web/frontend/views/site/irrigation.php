<?php
/** @var yii\web\View $this */
$this->title = 'Irrigation Control';
?>
<div style="display: flex; flex-direction: column; gap: var(--space-5);">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="text-h2">Irrigation Control</h1>
        <span class="ds-badge ds-badge-warning">Auto Mode</span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr; gap: var(--space-5); @media(min-width: 1024px){ grid-template-columns: 1fr 2fr; }">
        <!-- Control Panel -->
        <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
            <h3 class="text-h3" style="margin-bottom: var(--space-4);">Manual Override</h3>
            
            <div style="display: flex; justify-content: center; padding: var(--space-6) 0;">
                <button id="big-pump-btn" style="width: 150px; height: 150px; border-radius: 50%; background-color: var(--gray-100); border: 8px solid var(--gray-200); color: var(--gray-500); font-weight: 700; font-size: 24px; cursor: pointer; transition: all 0.3s; box-shadow: inset 0 4px 6px rgba(0,0,0,0.1);">
                    OFF
                </button>
            </div>
            <p class="text-body text-gray-500 text-center mt-4">Tap to manually toggle the main water pump. This overrides the automatic schedule for 30 minutes.</p>
        </div>

        <!-- Schedules -->
        <div style="background: white; padding: var(--space-5); border-radius: var(--radius-md); box-shadow: var(--elevation-1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-4);">
                <h3 class="text-h3">Active Schedules</h3>
                <button class="ds-btn-primary" style="padding: var(--space-1) var(--space-3); font-size: 12px;">+ Add</button>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                <div style="border: 1px solid var(--gray-200); padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="text-body-lg font-bold">Morning Watering</p>
                        <p class="text-caption text-gray-500">Everyday • 06:00 • 15 mins</p>
                    </div>
                    <button style="width: 40px; height: 24px; border-radius: 12px; background-color: var(--primary-500); border: none; position: relative;">
                        <span style="position: absolute; right: 2px; top: 2px; width: 20px; height: 20px; background: white; border-radius: 50%;"></span>
                    </button>
                </div>
                <div style="border: 1px solid var(--gray-200); padding: var(--space-3) var(--space-4); border-radius: var(--radius-sm); display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="text-body-lg font-bold">Evening Supplemental</p>
                        <p class="text-caption text-gray-500">Mon, Wed, Fri • 17:30 • 10 mins</p>
                    </div>
                    <button style="width: 40px; height: 24px; border-radius: 12px; background-color: var(--primary-500); border: none; position: relative;">
                        <span style="position: absolute; right: 2px; top: 2px; width: 20px; height: 20px; background: white; border-radius: 50%;"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const pumpBtn = document.getElementById('big-pump-btn');
    let isPumpOn = false;
    if(pumpBtn){
        pumpBtn.addEventListener('click', () => {
            isPumpOn = !isPumpOn;
            if(isPumpOn){
                pumpBtn.style.backgroundColor = 'var(--primary-100)';
                pumpBtn.style.borderColor = 'var(--primary-500)';
                pumpBtn.style.color = 'var(--primary-700)';
                pumpBtn.textContent = 'ON';
            } else {
                pumpBtn.style.backgroundColor = 'var(--gray-100)';
                pumpBtn.style.borderColor = 'var(--gray-200)';
                pumpBtn.style.color = 'var(--gray-500)';
                pumpBtn.textContent = 'OFF';
            }
        });
    }
</script>
