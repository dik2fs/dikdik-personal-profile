@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">Hubungi Saya</h1>
        
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek *</label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan *</label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary w-full">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Contact Info -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <h3 class="text-2xl font-semibold mb-6">Informasi Kontak</h3>
                @php
                    $profileData = \App\Models\Profile::first();
                @endphp
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-blue-600 mr-4"></i>
                        <div>
                            <p class="font-semibold">Email</p>
                            <p class="text-gray-600">{{ $profileData->email ?? 'email@example.com' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fas fa-phone text-blue-600 mr-4"></i>
                        <div>
                            <p class="font-semibold">Telepon</p>
                            <p class="text-gray-600">{{ $profileData->phone ?? '+62 812-3456-7890' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-blue-600 mr-4"></i>
                        <div>
                            <p class="font-semibold">Lokasi</p>
                            <p class="text-gray-600">{{ $profileData->location ?? 'Jakarta, Indonesia' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection