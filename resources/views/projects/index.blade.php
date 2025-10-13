@extends('layouts.app')

@section('title', 'Proyek')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">Proyek Saya</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
            <div class="card-hover bg-white rounded-lg shadow-md overflow-hidden">
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" 
                     alt="{{ $project->title }}" 
                     class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 120) }}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($project->technologies as $tech)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div class="flex space-x-4">
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" 
                           target="_blank"
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            Live Demo
                        </a>
                        @endif
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" 
                           target="_blank"
                           class="text-gray-600 hover:text-gray-800 font-semibold">
                            GitHub
                        </a>
                        @endif
                        <a href="{{ route('projects.show', $project->id) }}" 
                           class="text-green-600 hover:text-green-800 font-semibold ml-auto">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">Belum ada proyek yang ditampilkan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection