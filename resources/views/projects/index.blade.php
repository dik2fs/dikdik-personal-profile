@extends('layouts.app')

@section('title', 'Proyek')

@section('content')

<!-- HEADER SECTION -->
<section class="bg-gradient-to-br from-blue-600 to-purple-700 text-white py-20">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Proyek Saya</h1>
        <p class="text-lg md:text-xl opacity-90">
            Kumpulan proyek terbaik yang pernah saya kerjakan dan kembangkan.
        </p>
    </div>
</section>


<!-- PROJECT GRID -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($projects as $project)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">

                <!-- Image -->
                @if($project->image)
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/' . $project->image) }}"
                         alt="{{ $project->title }}"
                         class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </div>
                @else
                <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
                @endif

                <!-- Content -->
                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                        {{ $project->title }}
                    </h3>

                    <p class="text-gray-600 mb-4 leading-relaxed">
                        {{ Str::limit($project->description, 110) }}
                    </p>

                    <!-- Technology Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if(is_array($project->technologies))
                            @foreach($project->technologies as $tech)
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-lg">
                                {{ $tech }}
                            </span>
                            @endforeach
                        @else
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-lg">
                            {{ $project->technologies }}
                        </span>
                        @endif
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex items-center gap-4 mt-3">

                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition">
                            <i class="fas fa-external-link-alt mr-2"></i> Live Demo
                        </a>
                        @endif

                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank"
                           class="inline-flex items-center text-gray-700 hover:text-black font-medium transition">
                            <i class="fab fa-github mr-2"></i> GitHub
                        </a>
                        @endif

                        <a href="{{ route('projects.show', $project->id) }}"
                           class="ml-auto inline-flex items-center text-green-600 hover:text-green-800 font-semibold transition">
                            <i class="fas fa-info-circle mr-2"></i> Detail
                        </a>
                    </div>

                </div>
            </div>
            @empty

            <!-- EMPTY STATE -->
            <div class="col-span-3 text-center py-20">
                <div class="bg-white rounded-2xl shadow p-12 max-w-md mx-auto">
                    <i class="fas fa-box-open text-gray-400 text-5xl mb-6"></i>
                    <p class="text-gray-600 text-lg">Belum ada proyek yang ditampilkan</p>
                    <p class="text-gray-400 mt-1">Proyek akan ditambahkan segera</p>
                </div>
            </div>

            @endforelse

        </div>

    </div>
</section>

@endsection
