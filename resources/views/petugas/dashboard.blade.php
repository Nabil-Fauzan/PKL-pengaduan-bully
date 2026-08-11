@extends('layouts.admin')

@section('title', 'Dashboard Petugas')
@section('page_title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title font-weight-bold mb-3">Selamat Datang, {{ Auth::user()->nama }}!</h5>
                <p class="card-text">
                    Ini adalah halaman dashboard untuk petugas dan admin. Halaman ini saat ini sengaja dikosongkan terlebih dahulu sesuai dengan instruksi pengerjaan.
                </p>
                <p class="card-text">
                    Anda login dengan username: <strong>{{ Auth::user()->username }}</strong>, email: <strong>{{ Auth::user()->email }}</strong>, dan memiliki hak akses sebagai: <strong>{{ ucfirst(Auth::user()->role) }}</strong>.
                </p>
                
                <hr>

                <!-- Logout Link in page content body -->
                <a href="#" onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) { document.getElementById('logout-form').submit(); }" class="text-danger font-weight-bold">
                    Keluar (Logout) &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
