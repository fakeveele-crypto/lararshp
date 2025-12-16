<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit Hewan Pendidikan - UNAIR')</title>

    {{-- Tautan Wajib --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top bg-white">
        <div class="container">
            <a href="{{ route('site.home') }}">
                <img src="{{ asset('assets/images/uner.png') }}" alt="Logo UNAIR" style="height: 40px;" class="me-2">
                <div>
                    <h5 class="mb-0 text-primary fw-bold">RUMAH SAKIT HEWAN PENDIDIKAN</h5>
                    <small class="text-muted">UNIVERSITAS AIRLANGGA</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mx-auto">
                    <a class="nav-link nav-link-custom @if(request()->routeIs('site.home')) active @endif" aria-current="page" href="{{ route('site.home') }}">Home</a>
                    <a class="nav-link nav-link-custom @if(request()->routeIs('struktur')) active @endif" href="{{ route('struktur') }}">Struktur Organisasi</a>
                    <a class="nav-link nav-link-custom @if(request()->routeIs('layanan')) active @endif" href="{{ route('layanan') }}">Layanan Umum</a>
                    <a class="nav-link nav-link-custom @if(request()->routeIs('visimisi')) active @endif" href="{{ route('visimisi') }}">Visi Misi &amp; Tujuan</a>
                </div>
                <div class="d-flex align-items-center ms-auto">
                    {{-- Right-side: auth links --}}
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span style="display:flex; align-items:center; gap:8px">
                            <span style="font-weight:700;">{{ Auth::user()->name }}</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-link">{{ __('Logout') }}</button>
                            </form>
                        </span>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
