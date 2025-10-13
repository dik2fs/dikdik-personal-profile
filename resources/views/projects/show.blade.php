@extends('layouts.app')

@section('title', $project->title)

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <div class="mb-8">
            <a href="{{ route('projects') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                ← Kembali ke Daftar Proyek
            </a>
            <h1 class="text-4xl font-bold mb-4">{{ $project->title }}</h1>
            
            @if($project->image)
            <img src="{{ asset('storage/' . $project->image) }}" 
                 alt="{{ $project->title }}" 
                 class="w-full h-64 object-cover rounded-lg mb-6">
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-semibold mb-4">Deskripsi Proyek</h2>
                <p class="text-gray-700 leading-relaxed mb-6">{{ $project->description }}</p>
                
                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-3">Teknologi yang Digunakan</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4">Link Proyek</h3>
                    <div class="space-y-3">
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" 
                           target="_blank"
                           class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Live Demo</span>
                        </a>
                        @endif
                        
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" 
                           target="_blank"
                           class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                            <i class="fab fa-github"></i>
                            <span>Source Code</span>
                        </a>
                        @endif
                    </div>
                    
                    @if($project->featured)
                    <div class="mt-4 flex items-center space-x-2 text-yellow-600">
                        <i class="fas fa-star"></i>
                        <span class="font-semibold">Proyek Unggulan</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection