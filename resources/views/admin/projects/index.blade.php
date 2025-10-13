@extends('admin.layouts.app')

@section('title', 'Kelola Proyek')
@section('header', 'Kelola Proyek')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Daftar Proyek</h2>
        <p class="text-gray-600">Kelola semua proyek portfolio Anda</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" 
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
        <i class="fas fa-plus mr-2"></i>
        Tambah Proyek
    </a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        @if($projects->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Gambar</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Teknologi</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-16 h-16 object-cover rounded">
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $project->title }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 50) }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @foreach(array_slice($project->technologies, 0, 3) as $tech)
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $tech }}</span>
                                @endforeach
                                @if(count($project->technologies) > 3)
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">+{{ count($project->technologies) - 3 }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if($project->featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i>
                                Unggulan
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Normal
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" 
                                   class="text-blue-600 hover:text-blue-800"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('projects.show', $project->id) }}" 
                                   target="_blank"
                                   class="text-green-600 hover:text-green-800"
                                   title="Lihat">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-8">
            <i class="fas fa-project-diagram text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada proyek</p>
            <p class="text-gray-400 mt-2">Mulai dengan menambahkan proyek pertama Anda</p>
            <a href="{{ route('admin.projects.create') }}" 
               class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                <i class="fas fa-plus mr-2"></i>
                Tambah Proyek Pertama
            </a>
        </div>
        @endif
    </div>
</div>
@endsection