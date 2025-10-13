@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Cards -->
    <div class="stat-card border-blue-500">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <i class="fas fa-project-diagram text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Total Proyek</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_projects'] }}</p>
            </div>
        </div>
    </div>

    <div class="stat-card border-green-500">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-star text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Proyek Unggulan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['featured_projects'] }}</p>
            </div>
        </div>
    </div>

    <div class="stat-card border-yellow-500">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-lg">
                <i class="fas fa-envelope text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Pesan Baru</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['unread_messages'] }}</p>
            </div>
        </div>
    </div>

    <div class="stat-card border-purple-500">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg">
                <i class="fas fa-comments text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-600">Total Pesan</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_messages'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Messages -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Pesan Terbaru</h3>
        </div>
        <div class="p-6">
            @if($recentMessages->count() > 0)
            <div class="space-y-4">
                @foreach($recentMessages as $message)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg {{ !$message->read ? 'bg-blue-50 border-blue-200' : '' }}">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            @if(!$message->read)
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            @endif
                            <p class="font-semibold text-gray-900">{{ $message->name }}</p>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->subject, 50) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.contacts.show', $message) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">Belum ada pesan</p>
            @endif
            
            @if($stats['total_messages'] > 5)
            <div class="mt-4 text-center">
                <a href="{{ route('admin.contacts.index') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">
                    Lihat Semua Pesan
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Proyek Terbaru</h3>
        </div>
        <div class="p-6">
            @if($recentProjects->count() > 0)
            <div class="space-y-4">
                @foreach($recentProjects as $project)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            @if($project->featured)
                            <i class="fas fa-star text-yellow-500"></i>
                            @endif
                            <p class="font-semibold text-gray-900">{{ $project->title }}</p>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 60) }}</p>
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach(array_slice($project->technologies, 0, 3) as $tech)
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.projects.edit', $project) }}" 
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">Belum ada proyek</p>
            @endif
            
            <div class="mt-4 text-center">
                <a href="{{ route('admin.projects.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Proyek
                </a>
            </div>
        </div>
    </div>
</div>
@endsection