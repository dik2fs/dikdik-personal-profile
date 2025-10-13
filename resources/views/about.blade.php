@extends('layouts.app')

@section('title', 'Tentang Saya')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">Tentang Saya</h1>
        
        <div class="flex flex-col md:flex-row items-center gap-8 mb-12">
            @if($profile->photo ?? false)
            <div class="flex-shrink-0">
                <img src="{{ asset('storage/' . $profile->photo) }}" 
                     alt="{{ $profile->name }}" 
                     class="w-64 h-64 rounded-full object-cover border-4 border-gray-200">
            </div>
            @endif
            <div>
                <h2 class="text-2xl font-bold mb-4">{{ $profile->name ?? 'Nama Anda' }}</h2>
                <p class="text-xl text-gray-600 mb-4">{{ $profile->title ?? 'Web Developer' }}</p>
                <div class="space-y-2 text-gray-700">
                    <p><i class="fas fa-envelope mr-2"></i>{{ $profile->email ?? 'email@example.com' }}</p>
                    <p><i class="fas fa-phone mr-2"></i>{{ $profile->phone ?? '+62 812-3456-7890' }}</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>{{ $profile->location ?? 'Jakarta, Indonesia' }}</p>
                </div>
            </div>
        </div>

        <div class="prose max-w-none">
            <h3 class="text-2xl font-bold mb-4">Biografi</h3>
            <p class="text-gray-700 leading-relaxed">{{ $profile->bio ?? 'Bio Anda akan ditampilkan di sini.' }}</p>
        </div>
    </div>
</section>
@endsection