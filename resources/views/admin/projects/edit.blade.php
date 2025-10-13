@extends('admin.layouts.app')

@section('title', 'Edit Proyek')
@section('header', 'Edit Proyek')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Dasar</h3>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Proyek *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $project->title) }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="project_url" class="block text-sm font-medium text-gray-700">URL Proyek</label>
                        <input type="url" 
                               id="project_url" 
                               name="project_url" 
                               value="{{ old('project_url', $project->project_url) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="github_url" class="block text-sm font-medium text-gray-700">URL GitHub</label>
                        <input type="url" 
                               id="github_url" 
                               name="github_url" 
                               value="{{ old('github_url', $project->github_url) }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="featured" 
                               name="featured" 
                               value="1"
                               {{ old('featured', $project->featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 block text-sm text-gray-700">
                            Tandai sebagai proyek unggulan
                        </label>
                    </div>
                </div>

                <!-- Media & Technologies -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Media & Teknologi</h3>
                    
                    <!-- Current Image -->
                    @if($project->image)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-32 h-32 object-cover rounded border-2 border-gray-300">
                        </div>
                    </div>
                    @endif

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">
                            {{ $project->image ? 'Ganti Gambar' : 'Upload Gambar' }}
                        </label>
                        <input type="file" 
                               id="image" 
                               name="image"
                               accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Technologies -->
                    <div>
                        <label for="technologies" class="block text-sm font-medium text-gray-700">Teknologi *</label>
                        <div id="technologies-container" class="mt-2 space-y-2">
                            @foreach(old('technologies', $project->technologies) as $tech)
                            <div class="flex space-x-2">
                                <input type="text" 
                                       name="technologies[]" 
                                       value="{{ $tech }}"
                                       placeholder="Contoh: Laravel"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" 
                                        onclick="removeTechnologyField(this)"
                                        class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            @endforeach
                            <div class="flex space-x-2">
                                <input type="text" 
                                       name="technologies[]" 
                                       placeholder="Tambah teknologi baru"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" 
                                        onclick="addTechnologyField()"
                                        class="px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Tekan tombol + untuk menambah teknologi</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Proyek *</label>
                <textarea id="description" 
                          name="description" 
                          rows="6"
                          required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Submit Buttons -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.projects.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    Update Proyek
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function addTechnologyField() {
        const container = document.getElementById('technologies-container');
        const newField = document.createElement('div');
        newField.className = 'flex space-x-2';
        newField.innerHTML = `
            <input type="text" 
                   name="technologies[]" 
                   placeholder="Contoh: Vue.js"
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <button type="button" 
                    onclick="removeTechnologyField(this)"
                    class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                <i class="fas fa-minus"></i>
            </button>
        `;
        container.appendChild(newField);
    }

    function removeTechnologyField(button) {
        if (document.querySelectorAll('#technologies-container .flex.space-x-2').length > 1) {
            button.parentElement.remove();
        }
    }
</script>
@endsection