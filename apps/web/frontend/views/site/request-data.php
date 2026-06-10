<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Request Data Download';
?>
<div class="request-data-page">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: var(--space-5);">
            <h2 class="text-h3" style="margin-bottom: 8px;">Request Data Download</h2>
            <p class="text-body text-gray-500">Silakan isi formulir pengajuan untuk mendownload data sensor. Admin akan meninjau pengajuan Anda maksimal 2x24 jam.</p>
        </div>

        <div style="background: white; padding: var(--space-5); border-radius: var(--radius-lg); box-shadow: var(--elevation-2);">
            <form id="requestDataForm" enctype="multipart/form-data">
                
                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Nama Lengkap</label>
                    <input type="text" name="full_name" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm);" placeholder="Masukkan nama lengkap Anda">
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm);" placeholder="Masukkan alamat email Anda">
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">NIM / NIP</label>
                    <input type="text" name="nim_nip" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm);" placeholder="Masukkan NIM atau NIP Anda">
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Tipe Data</label>
                    <select name="data_type" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm); background: white;">
                        <option value="monitoring">Raw Sensor Data (Monitoring)</option>
                        <option value="analytics">Aggregated Data (Analytics)</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Pilih Sensor (Bisa lebih dari satu)</label>
                    <div style="display: flex; flex-direction: column; gap: 8px; border: 1px solid var(--gray-200); padding: 12px; border-radius: var(--radius-sm); background: var(--gray-50);">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="sensor_all" value="all" checked onchange="toggleSensors(this)"> Semua Sensor
                        </label>
                        <div style="height: 1px; background: var(--gray-200); margin: 4px 0;"></div>
                        <div class="sensor-checkboxes" style="display: flex; flex-direction: column; gap: 8px; margin-left: 8px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" name="sensors[]" value="moisture" class="sensor-cb" checked disabled> Soil Moisture
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" name="sensors[]" value="ph" class="sensor-cb" checked disabled> Water pH
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" name="sensors[]" value="tds" class="sensor-cb" checked disabled> TDS
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" name="sensors[]" value="temperature" class="sensor-cb" checked disabled> Temperature
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="checkbox" name="sensors[]" value="ultrasonic" class="sensor-cb" checked disabled> Water Tank Level
                            </label>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: var(--space-4); margin-bottom: var(--space-4);">
                    <div class="form-group" style="flex: 1 1 150px;">
                        <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Dari Tanggal</label>
                        <input type="date" name="date_start" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm);">
                    </div>
                    <div class="form-group" style="flex: 1 1 150px;">
                        <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Sampai Tanggal</label>
                        <input type="date" name="date_end" required style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm);">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-4);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Alasan Pengajuan</label>
                    <textarea name="reason" required rows="4" style="width: 100%; padding: 10px; border: 1px solid var(--gray-200); border-radius: var(--radius-sm); resize: vertical;" placeholder="Jelaskan untuk keperluan apa data ini akan digunakan (cth: Tugas Akhir, Penelitian, dll)"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: var(--space-6);">
                    <label class="text-caption font-medium text-gray-900" style="display: block; margin-bottom: 8px;">Surat Pengajuan (PDF Bertanda Tangan)</label>
                    <div style="border: 2px dashed var(--gray-300); padding: var(--space-5); text-align: center; border-radius: var(--radius-sm); background: var(--gray-50); cursor: pointer;" onclick="document.getElementById('docInput').click()">
                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="text-caption text-gray-600" id="fileNameDisplay">Klik untuk memilih file PDF (Max 5MB)</p>
                        <input type="file" id="docInput" name="document" accept="application/pdf" required style="display: none;" onchange="document.getElementById('fileNameDisplay').textContent = this.files[0] ? this.files[0].name : 'Klik untuk memilih file PDF (Max 5MB)'">
                    </div>
                </div>

                <button type="submit" class="ds-btn-primary" style="width: 100%; justify-content: center; padding: 12px; font-size: 16px;" id="submitBtn">
                    Kirim Pengajuan
                </button>
            </form>

            <!-- Success State -->
            <div id="successState" style="display: none; text-align: center; padding: var(--space-4) 0;">
                <div style="width: 64px; height: 64px; background: #DCFCE7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4);">
                    <svg class="w-8 h-8" style="color: var(--primary-600);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="text-h3" style="margin-bottom: var(--space-2);">Pengajuan Berhasil Dikirim</h3>
                <p class="text-body text-gray-600 mb-4">Pengajuan Anda telah diterima oleh sistem. Detail pengajuan akan otomatis terkirim ke email Anda. Silakan tunggu tanggapan dari Admin melalui email.</p>
                <button onclick="location.reload()" class="ds-btn-primary" style="text-decoration: none;">Kembali ke Form</button>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSensors(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.sensor-cb');
    checkboxes.forEach(cb => {
        cb.disabled = masterCheckbox.checked;
        if(masterCheckbox.checked) cb.checked = true;
    });
}

document.getElementById('requestDataForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Mengirim...';

    const formData = new FormData(this);
    
    // Process sensors
    let selectedSensors = [];
    if (formData.get('sensor_all') === 'all') {
        selectedSensors = ['all'];
    } else {
        const checkboxes = document.querySelectorAll('.sensor-cb:checked:not(:disabled)');
        checkboxes.forEach(cb => selectedSensors.push(cb.value));
    }
    formData.set('requested_sensors', JSON.stringify(selectedSensors));

    try {
        const response = await fetch('http://localhost:8000/api/data-requests/', {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            const result = await response.json();
            document.getElementById('requestDataForm').style.display = 'none';
            document.getElementById('successState').style.display = 'block';
            document.getElementById('trackingCodeDisplay').textContent = result.tracking_code;
        } else {
            const err = await response.json();
            alert('Gagal mengirim pengajuan: ' + (err.detail || 'Unknown error'));
            btn.disabled = false;
            btn.textContent = 'Kirim Pengajuan';
        }
    } catch (err) {
        alert('Terjadi kesalahan jaringan.');
        btn.disabled = false;
        btn.textContent = 'Kirim Pengajuan';
    }
});
</script>
