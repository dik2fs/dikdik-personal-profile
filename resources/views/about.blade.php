@extends('layouts.app')

@section('title', 'Tentang Saya')

@section('content')

<!-- HERO / HEADER SECTION -->
<section class="bg-gradient-to-br from-blue-600 to-purple-700 text-white py-20">
    <div class="max-w-5xl mx-auto px-6 text-center">

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4">
            Tentang Saya
        </h1>

        <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
            Kenali lebih dekat perjalanan profesional, latar belakang, dan karya terbaik saya.
        </p>
    </div>
</section>

<!-- PROFILE SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

        <!-- Profile Image -->
        <div class="flex justify-center">
            @if($profile->photo ?? false)
            <img src="{{ asset('storage/' . $profile->photo) }}"
                 alt="{{ $profile->name }}"
                 class="w-60 h-60 md:w-72 md:h-72 rounded-3xl object-cover shadow-2xl ring-4 ring-white">
            @else
            <div class="w-72 h-72 bg-gray-200 rounded-3xl"></div>
            @endif
        </div>

        <!-- Profile Info -->
        <div>
            <h2 class="text-3xl font-bold mb-2">{{ $profile->name ?? 'Nama Anda' }}</h2>
            <p class="text-xl text-blue-600 mb-6">{{ $profile->title ?? 'Web Developer' }}</p>

            <div class="space-y-3 text-gray-700">
                <p><i class="fas fa-envelope text-blue-600 mr-2"></i>{{ $profile->email ?? 'email@example.com' }}</p>
                <p><i class="fas fa-phone text-blue-600 mr-2"></i>{{ $profile->phone ?? '+62 812-3456-7890' }}</p>
                <p><i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>{{ $profile->location ?? 'Indonesia' }}</p>
            </div>

            <a href="{{ route('contact') }}"
               class="inline-block mt-8 px-8 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 transition">
               Hubungi Saya
            </a>
        </div>
    </div>
</section>

<!-- BIO / HISTORY SECTION -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <h3 class="text-3xl font-bold text-gray-900 mb-6 text-center">Biografi</h3>

        <div class="text-gray-700 leading-relaxed text-lg bg-white p-8 rounded-2xl shadow-lg">
            {!! nl2br(e($profile->bio ?? 'Bio Anda akan ditampilkan di sini.')) !!}
        </div>
    </div>
</section>

<!-- EXPERIENCE / SKILLS SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h3 class="text-3xl font-bold text-gray-900 mb-12">Keahlian & Kompetensi</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-xl transition">
                <i class="fas fa-laptop-code text-blue-600 text-3xl mb-4"></i>
                <h4 class="font-semibold text-xl mb-2">Web Development</h4>
                <p class="text-gray-600 text-sm">Pengembangan aplikasi modern, backend & frontend.</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-xl transition">
                <i class="fas fa-pen-nib text-blue-600 text-3xl mb-4"></i>
                <h4 class="font-semibold text-xl mb-2">Penulisan Buku</h4>
                <p class="text-gray-600 text-sm">Penulis aktif berbagai buku akademik & profesional.</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-xl transition">
                <i class="fas fa-chalkboard-teacher text-blue-600 text-3xl mb-4"></i>
                <h4 class="font-semibold text-xl mb-2">Pengajaran & Training</h4>
                <p class="text-gray-600 text-sm">Berpengalaman dalam pelatihan dan edukasi digital.</p>
            </div>

        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ingin Berkolaborasi?</h2>
        <p class="text-lg md:text-xl opacity-90 mb-8">Mari wujudkan ide dan project terbaik bersama saya.</p>

        <a href="{{ route('contact') }}"
           class="px-10 py-4 bg-white text-blue-700 font-semibold rounded-xl hover:bg-gray-100 transition">
            Hubungi Saya
        </a>
    </div>
</section>

@endsection
