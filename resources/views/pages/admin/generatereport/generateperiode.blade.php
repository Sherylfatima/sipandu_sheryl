@extends('layouts.layoutadmin')
@section('content')
<section class="content">
    <!-- Content Header (Page header) -->
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-secondary btn-md"><li class="fa fa-print"></li> Cetak Laporan</button>
                <a href="/generatereport" class="btn btn-warning btn-md float-sm-right"><li class="fa fa-undo"></li> Kembali</a>
            </div>
            <div class="card-body report">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="h-report"> APM Masyarakat Seluruh Indonesia </div>
                        <div class="h-report-detail">
                            <li class="fa fa-bars"></li> Jl.  No. 123 Jawa Barat KP. 12345 <li
                                class="fa fa-phone"></li> +1 1233456788
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        Laporan Pengaduan Bulan : Januari 2024
                    </div>
                </div>
                <!-- <div class="row"> -->
                <div class="container-responsive mt-3">

                    <table class="table table-bordered table-hover table-report">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pengaduan</th>
                                <th>Kategori Pengaduan</th>
                                <th>Nama Maysarakat</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>12 Januari 2024</td>
                                <td>Pelecehan</td>
                                <td>Teguh</td>
                                <td>Process</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>12 Januari 2024</td>
                                <td>Pelecehan</td>
                                <td>Teguh</td>
                                <td>Process</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>12 Januari 2024</td>
                                <td>Pencemaran</td>
                                <td>Teguh</td>
                                <td>Selesai</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        Langen, Februari 2024 <br>
                        Petugas
                        <br><br><br>
                        <b> Nama Petugas</b>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- /.content -->
</section>
@endsection