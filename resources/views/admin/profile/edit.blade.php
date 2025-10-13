@extends('admin.layouts.app')

@section('title', 'Edit Profil')
@section('header', 'Edit Profil')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Pribadi</h3>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $profile->name ?? '') }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Profesi *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $profile->title ?? '') }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $profile->email ?? '') }}"
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $profile->phone ?? '') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location', $profile->location ?? '') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Media & Files -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Media & File</h3>
                    
                    <!-- Photo Upload -->
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                        @if(isset($profile->photo) && $profile->photo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $profile->photo) }}" 
                                 alt="Current Photo" 
                                 class="w-32 h-32 rounded-full object-cover border-2 border-gray-300">
                        </div>
                        @endif
                        <input type="file" 
                               id="photo" 
                               name="photo"
                               accept="image/*"
                               class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- CV Upload -->
                    <div>
                        <label for="cv_path" class="block text-sm font-medium text-gray-700">CV/Resume</label>
                        @if(isset($profile->cv_path) && $profile->cv_path)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $profile->cv_path) }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                                <i class="fas fa-file-pdf"></i>
                                <span>Lihat CV Saat Ini</span>
                            </a>
                        </div>
                        @endif
                        <input type="file" 
                               id="cv_path" 
                               name="cv_path"
                               accept=".pdf,.doc,.docx"
                               class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
            </div>

            <!-- Bio -->
            <div class="mt-6">
                <label for="bio" class="block text-sm font-medium text-gray-700">Biografi *</label>
                <textarea id="bio" 
                          name="bio" 
                          rows="6"
                          required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('bio', $profile->bio ?? '') }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection