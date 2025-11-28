@extends('layouts.app')

@section('title', 'Kontak Saya')

@section('content')

<!-- HEADER -->
<section class="bg-gradient-to-br from-blue-700 to-purple-700 text-white py-20">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Hubungi Saya</h1>
        <p class="text-lg md:text-xl opacity-90">
            Ada pertanyaan, kebutuhan kerja sama, atau ingin berdiskusi? Silakan hubungi saya melalui form atau kontak di bawah.
        </p>
    </div>
</section>

<!-- MAIN CONTACT SECTION -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16">

        <!-- LEFT SIDE — CONTACT INFO -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
            <p class="text-gray-600 leading-relaxed mb-8">
                Saya selalu terbuka untuk kolaborasi, diskusi, maupun pertanyaan terkait proyek, buku, atau pekerjaan profesional lainnya.
            </p>

            <div class="space-y-6">

                <!-- Email -->
                <div class="flex items-center gap-4 p-5 bg-white shadow rounded-xl">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Email</p>
                        <p class="text-gray-600">{{ $profile->email ?? 'email@example.com' }}</p>
                    </div>
                </div>

                <!-- Phone / WhatsApp -->
                <div class="flex items-center gap-4 p-5 bg-white shadow rounded-xl">
                    <div class="w-12 h-12 bg-green-600 text-white rounded-full flex items-center justify-center text-xl">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">WhatsApp</p>
                        <p class="text-gray-600">{{ $profile->phone ?? '6281311203436' }}</p>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex items-center gap-4 p-5 bg-white shadow rounded-xl">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Lokasi</p>
                        <p class="text-gray-600">{{ $profile->location ?? 'Indonesia' }}</p>
                    </div>
                </div>

            </div>

            <a href="https://wa.me/{{ $profile->phone ?? '6281311203436' }}"
               target="_blank"
               class="mt-10 inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition">
                <i class="fab fa-whatsapp text-xl mr-2"></i> Chat via WhatsApp
            </a>
        </div>

        <!-- RIGHT SIDE — CONTACT FORM -->
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

            @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Subject -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Subjek</label>
                    <input type="text" name="subject" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Message -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Pesan</label>
                    <textarea name="message" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-4 bg-blue-600 text-white rounded-xl font-semibold text-lg hover:bg-blue-700 transition">
                    Kirim Pesan
                </button>
            </form>
        </div>

    </div>
</section>

@endsection
