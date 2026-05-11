<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portal Sekolah') }} - Beranda</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-900">{{ config('app.name', 'Portal Sekolah') }}</h1>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-900 hover:text-blue-600 px-3 py-2 text-sm font-medium">Beranda</a>
                    <a href="#berita" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Berita</a>
                    <a href="#eskul" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Ekstrakurikuler</a>
                    <a href="#agenda" class="text-gray-500 hover:text-blue-600 px-3 py-2 text-sm font-medium">Agenda</a>
                </nav>
                <!-- Kontainer Navigasi Kanan -->
<div class="flex items-center space-x-2 md:space-x-4">
    @if (Route::has('login'))
        @auth
            <!-- Jika User Sudah Login -->
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">
                Dashboard
            </a>
        @else
            <!-- Jika User Belum Login: Tombol Login dan Daftar Samping-Sampingan -->
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                Login
            </a>
            
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 text-sm font-medium transition-colors">
                    Daftar
                </a>
            @endif
        @endauth
    @endif
</div>
                <!-- Mobile menu button -->
                <!-- <div class="md:hidden">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div> -->
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="/" class="text-gray-900 hover:text-blue-600 block px-3 py-2 text-base font-medium">Beranda</a>
                <a href="#berita" class="text-gray-500 hover:text-blue-600 block px-3 py-2 text-base font-medium">Berita</a>
                <a href="#eskul" class="text-gray-500 hover:text-blue-600 block px-3 py-2 text-base font-medium">Ekstrakurikuler</a>
                <a href="#agenda" class="text-gray-500 hover:text-blue-600 block px-3 py-2 text-base font-medium">Agenda</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white block px-3 py-2 text-base font-medium rounded-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-blue-600 block px-3 py-2 text-base font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white block px-3 py-2 text-base font-medium rounded-md">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Selamat Datang di {{ config('app.name', 'Portal Sekolah') }}</h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">Platform informasi dan manajemen sekolah modern</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#berita" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">Lihat Berita</a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">Masuk Admin</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Berita::count() }}</div>
                    <div class="text-gray-600">Total Berita</div>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Eskul::count() }}</div>
                    <div class="text-gray-600">Ekstrakurikuler</div>
                </div>
                <div class="text-center">
                    <div class="bg-yellow-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Agenda::count() }}</div>
                    <div class="text-gray-600">Agenda Aktif</div>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-gray-900">{{ \App\Models\Berita::where('category','prestasi')->count() }}</div>
                    <div class="text-gray-600">Prestasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru -->
    <section id="berita" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-lg text-gray-600">Informasi terkini dari sekolah kami</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach(\App\Models\Berita::latest()->take(6)->get() as $berita)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $berita->title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($berita->excerpt ?? $berita->content, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ $berita->created_at->format('d M Y') }}</span>
                            <span class="text-sm text-blue-600 font-medium">{{ $berita->category }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('admin.berita.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name', 'Portal Sekolah') }}</h3>
                    <p class="text-gray-400">Platform modern untuk manajemen informasi sekolah</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="#berita" class="text-gray-400 hover:text-white">Berita</a></li>
                        <li><a href="#eskul" class="text-gray-400 hover:text-white">Ekstrakurikuler</a></li>
                        <li><a href="#agenda" class="text-gray-400 hover:text-white">Agenda</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <p class="text-gray-400">Email: info@sekolah.com</p>
                    <p class="text-gray-400">Telp: (021) 123-4567</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'Portal Sekolah') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html></content>