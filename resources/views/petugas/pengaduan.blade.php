@extends('layouts.admin')

@section('title', 'Data Pengaduan')
@section('page_title', 'Data Pengaduan')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title font-weight-bold mb-3">Daftar Pengaduan</h5>
                <p class="card-text">
                    Halaman ini adalah daftar pengaduan yang masuk. Halaman ini saat ini sengaja dikosongkan terlebih dahulu sesuai dengan instruksi pengerjaan.
                </p>
                <hr>
                <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) { document.getElementById('logout-form').submit(); }" class="text-danger font-weight-bold">
                    Keluar (Logout) &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
