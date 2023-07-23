@extends('layouts.main')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1><i class="bi bi-grid"></i> &nbsp;Dashboard</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="text-black fw-bold d-flex align-items-center" style="background-color: #EEF4FF; padding: 5px; margin-bottom: 5px; width: fit-content;">
                                    <i class="bi bi-box" style="font-size: 2.5rem; margin-right: 8px;"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;">Total Barang</span>
                                </div>
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;"> {{ $totalBarang }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="text-black fw-bold d-flex align-items-center" style="background-color: #EEF4FF; padding: 5px; margin-bottom: 5px; width: fit-content;">
                                    <i class="bi bi-exclamation-triangle" style="font-size: 2.5rem; margin-right: 8px;"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;">Total Barang Rusak</span>
                                </div>
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;"> {{ $totalKerusakan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="text-black fw-bold d-flex align-items-center" style="background-color: #EEF4FF; padding: 5px; margin-bottom: 5px; width: fit-content;">
                                    <i class="bi bi-person" style="font-size: 2.5rem; margin-right: 8px;"></i>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;">Total User</span>
                                </div>
                                <div class="text-black fw-bold">
                                    <span style="font-size: 20px;  margin-left: 8px;"> {{ $totalAllUser }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection