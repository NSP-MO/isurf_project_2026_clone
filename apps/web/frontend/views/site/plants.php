<?php
use yii\helpers\Html;

$this->title = 'Master Data Tanaman';
?>
<div class="plants-page">
    <div style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-6);">
        <div>
            <h1 class="text-h2" style="margin-bottom: var(--space-2);">Kelola Jenis Tanaman</h1>
            <p class="text-body text-gray-500">Kelola master data jenis tanaman, parameter ideal, dan foto tanaman.</p>
        </div>
        <button class="ds-btn-primary" style="white-space: nowrap;" onclick="openAddPlantModal()">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Tanaman
        </button>
    </div>

    <div style="background: white; border-radius: var(--radius-lg); box-shadow: var(--elevation-1); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead>
                <tr style="background: var(--gray-50); border-bottom: 1px solid var(--gray-200); text-align: left;">
                    <th style="padding: var(--space-4); color: var(--gray-500); font-size: 12px; font-weight: 600; text-transform: uppercase;">Tanaman</th>
                    <th style="padding: var(--space-4); color: var(--gray-500); font-size: 12px; font-weight: 600; text-transform: uppercase;">Parameter Ideal</th>
                    <th style="padding: var(--space-4); color: var(--gray-500); font-size: 12px; font-weight: 600; text-transform: uppercase; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody id="plantsTableBody">
                <tr><td colspan="3" style="text-align: center; padding: var(--space-6); color: var(--gray-500);">Loading plants...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Plant -->
<div id="addPlantModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: var(--space-4);">
    <div style="background: white; border-radius: var(--radius-lg); width: 100%; max-width: 500px; display: flex; flex-direction: column; box-shadow: var(--elevation-3);">
        <div style="padding: var(--space-5); border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center;">
            <h3 class="text-h3" style="margin: 0;">Tambah Jenis Tanaman</h3>
            <button onclick="closeAddPlantModal()" style="background: none; border: none; cursor: pointer; color: var(--gray-400);">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div style="padding: var(--space-5); max-height: 70vh; overflow-y: auto;">
            <div style="margin-bottom: 16px;">
                <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Nama Tanaman *</label>
                <input type="text" id="newPlantName" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;" placeholder="cth: Tomat Cherry">
            </div>
            <div style="margin-bottom: 16px;">
                <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Deskripsi Singkat</label>
                <textarea id="newPlantDesc" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;" rows="2"></textarea>
            </div>
            
            <h4 style="margin: 20px 0 10px 0; font-size: 14px; font-weight: 600;">Parameter Ideal</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <div>
                    <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Suhu Udara (°C)</label>
                    <input type="number" step="0.1" id="newPlantTemp" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;" placeholder="cth: 25.5">
                </div>
                <div>
                    <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Kelembapan Tanah (%)</label>
                    <input type="number" step="0.1" id="newPlantMoist" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;" placeholder="cth: 60">
                </div>
                <div>
                    <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Intensitas Cahaya (Lux)</label>
                    <input type="number" step="1" id="newPlantLight" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;" placeholder="cth: 1000">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label class="text-caption font-medium" style="display: block; margin-bottom: 8px;">Foto Tanaman</label>
                <input type="file" id="newPlantImage" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid var(--gray-300); border-radius: 4px;">
            </div>
        </div>
        <div style="padding: var(--space-5); border-top: 1px solid var(--gray-200); display: flex; justify-content: flex-end; gap: var(--space-3);">
            <button class="ds-btn-secondary" onclick="closeAddPlantModal()">Batal</button>
            <button class="ds-btn-primary" onclick="submitNewPlant()" id="submitPlantBtn">Simpan</button>
        </div>
    </div>
</div>

<script src="<?= Yii::getAlias('@web') ?>/js/isurf-api.js?v=<?= time() ?>"></script>
<script>
async function loadPlants() {
    const tbody = document.getElementById('plantsTableBody');
    const plants = await iSurfAPI.getPlants();
    
    if (plants.length === 0) {
        tbody.innerHTML = `<tr><td colspan="3" style="text-align: center; padding: var(--space-6); color: var(--gray-500);">Belum ada data tanaman terdaftar.</td></tr>`;
        return;
    }
    
    tbody.innerHTML = '';
    plants.forEach(plant => {
        const tr = document.createElement('tr');
        tr.style.borderBottom = '1px solid var(--gray-200)';
        
        let imgTag = plant.image_path 
            ? `<img src="/${plant.image_path}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 12px;">` 
            : `<div style="width: 50px; height: 50px; background: var(--gray-200); border-radius: 8px; margin-right: 12px; display: flex; align-items: center; justify-content: center;"><span style="color:var(--gray-500);font-size:24px;">🌱</span></div>`;
        
        tr.innerHTML = `
            <td style="padding: var(--space-4);">
                <div style="display: flex; align-items: center;">
                    ${imgTag}
                    <div>
                        <p style="font-weight: 600; color: var(--gray-900); margin: 0;">${plant.name}</p>
                        <p style="font-size: 13px; color: var(--gray-500); margin: 0;">${plant.description || '-'}</p>
                    </div>
                </div>
            </td>
            <td style="padding: var(--space-4);">
                <p style="font-size: 13px; margin: 0;">Suhu: <b>${plant.optimal_temperature ? plant.optimal_temperature+' °C' : '-'}</b></p>
                <p style="font-size: 13px; margin: 0;">Kelembapan: <b>${plant.optimal_moisture ? plant.optimal_moisture+' %' : '-'}</b></p>
                <p style="font-size: 13px; margin: 0;">Cahaya: <b>${plant.optimal_light ? plant.optimal_light+' Lux' : '-'}</b></p>
            </td>
            <td style="padding: var(--space-4); text-align: right; white-space: nowrap;">
                <button class="ds-btn-secondary" style="padding: 6px 12px; font-size: 13px; color: var(--red-600); border-color: var(--red-200);" onclick="deletePlant(${plant.id})">
                    Hapus
                </button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function openAddPlantModal() {
    document.getElementById('newPlantName').value = '';
    document.getElementById('newPlantDesc').value = '';
    document.getElementById('newPlantTemp').value = '';
    document.getElementById('newPlantMoist').value = '';
    document.getElementById('newPlantLight').value = '';
    document.getElementById('newPlantImage').value = '';
    document.getElementById('addPlantModal').style.display = 'flex';
}

function closeAddPlantModal() {
    document.getElementById('addPlantModal').style.display = 'none';
}

async function submitNewPlant() {
    const name = document.getElementById('newPlantName').value;
    if (!name) {
        alert("Nama tanaman wajib diisi!");
        return;
    }

    const btn = document.getElementById('submitPlantBtn');
    btn.disabled = true;
    btn.innerHTML = 'Menyimpan...';

    const formData = new FormData();
    formData.append('name', name);
    
    const desc = document.getElementById('newPlantDesc').value;
    if(desc) formData.append('description', desc);
    
    const temp = document.getElementById('newPlantTemp').value;
    if(temp) formData.append('optimal_temperature', temp);
    
    const moist = document.getElementById('newPlantMoist').value;
    if(moist) formData.append('optimal_moisture', moist);
    
    const light = document.getElementById('newPlantLight').value;
    if(light) formData.append('optimal_light', light);
    
    const imageInput = document.getElementById('newPlantImage');
    if (imageInput.files.length > 0) {
        formData.append('image', imageInput.files[0]);
    }

    try {
        await iSurfAPI.addPlant(formData);
        closeAddPlantModal();
        alert("Tanaman berhasil ditambahkan!");
        loadPlants();
    } catch (err) {
        alert("Gagal menambahkan: " + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = 'Simpan';
    }
}

async function deletePlant(id) {
    if(!confirm("Apakah Anda yakin ingin menghapus tanaman ini?")) return;
    try {
        await iSurfAPI.deletePlant(id);
        loadPlants();
    } catch (e) {
        alert("Gagal menghapus tanaman.");
    }
}

document.addEventListener('DOMContentLoaded', loadPlants);
</script>
