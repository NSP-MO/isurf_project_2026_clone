<?php

/** @var yii\web\View $this */
/** @var array $data */

$this->title = 'iSurf IoT Dashboard';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Welcome iSurf IoT Dashboard</h1>
        </div>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Suhu</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['suhu'] ?></h5>
                        <p class="card-text">°C</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Volume Air</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['volumeAir'] ?></h5>
                        <p class="card-text">liter</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">pH Tanah</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['phTanah'] ?></h5>
                        <p class="card-text">pH</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Kelembaban Tanah</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['kelembabanTanah'] ?></h5>
                        <p class="card-text">m3m-3</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Pengisian Air</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['statusPengisianAir'] ?></h5>
                        <p class="card-text">Servo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">TDS</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['tds'] ?></h5>
                        <p class="card-text">ppm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
