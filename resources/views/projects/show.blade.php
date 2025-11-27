@extends('layouts.app')

@section('title', $project->title)

@section('content')

<!-- HEADER -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('projects') }}" class="text-white/80 hover:text-white mb-6 inline-block">
            ← Kembali ke Daftar Proyek
        </a>

        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
            {{ $project->title }}
        </h1>

        <p class="text-lg opacity-90 max-w-2xl">
            {{ Str::limit($project->description, 150) }}
        </p>
    </div>
</section>


<!-- PROJECT DETAILS -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- Left Column - Description -->
        <div class="lg:col-span-2">

            @if($project->image)
            <div class="overflow-hidden rounded-2xl shadow-xl mb-8">
                <img src="{{ asset('storage/' . $project->image) }}"
                     alt="{{ $project->title }}"
                     class="w-full h-72 object-cover hover:scale-105 transition duration-500">
            </div>
            @endif

            <h2 class="text-2xl font-bold text-gray-900 mb-4">Deskripsi Proyek</h2>
            <p class="text-gray-700 text-lg leading-relaxed mb-8">
                {{ $project->description }}
            </p>

            <h3 class="text-xl font-semibold text-gray-900 mb-3">Teknologi yang Digunakan</h3>
            <div class="flex flex-wrap gap-2 mb-8">
                @foreach($project->technologies as $tech)
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                    {{ $tech }}
                </span>
                @endforeach
            </div>

        </div>

        <!-- Right Column - Project Info -->
        <div>

            <div class="bg-white shadow-lg rounded-2xl p-8">

                <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Proyek</h3>

                <div class="space-y-4">

                    @if($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank"
                       class="flex items-center space-x-3 text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Live Demo</span>
                    </a>
                    @endif

                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank"
                       class="flex items-center space-x-3 text-gray-700 hover:text-black font-medium">
                        <i class="fab fa-github"></i>
                        <span>Source Code</span>
                    </a>
                    @endif

                    @if($project->featured)
                    <div class="flex items-center space-x-3 text-yellow-600 mt-4">
                        <i class="fas fa-star text-xl"></i>
                        <span class="font-semibold">Proyek Unggulan</span>
                    </div>
                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
