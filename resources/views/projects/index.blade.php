@extends('layouts.app')

@section('title', 'Proyek')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">Proyek Saya</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" 
                     alt="{{ $project->title }}" 
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 120) }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if(is_array($project->technologies))
                            @foreach($project->technologies as $tech)
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                            @endforeach
                        @else
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $project->technologies }}</span>
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap gap-3 items-center">
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" 
                           target="_blank"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Live Demo
                        </a>
                        @endif
                        
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" 
                           target="_blank"
                           class="inline-flex items-center text-gray-600 hover:text-gray-800 font-semibold transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            GitHub
                        </a>
                        @endif
                        
                        <a href="{{ route('projects.show', $project->id) }}" 
                           class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold transition-colors ml-auto">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada proyek yang ditampilkan</p>
                    <p class="text-gray-400 mt-2">Proyek akan segera ditambahkan</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection