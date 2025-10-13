@extends('admin.layouts.app')

@section('title', 'Detail Pesan')
@section('header', 'Detail Pesan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">{{ $contact->subject }}</h2>
                <p class="text-sm text-gray-600 mt-1">
                    Dikirim pada {{ $contact->created_at->format('d F Y H:i') }}
                </p>
            </div>
            <div class="flex space-x-2">
                @if(!$contact->read)
                <form action="{{ route('admin.contacts.markAsRead', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" 
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 font-semibold">
                        <i class="fas fa-check mr-2"></i>
                        Tandai Sudah Dibaca
                    </button>
                </form>
                @else
                <span class="bg-green-100 text-green-800 px-3 py-2 rounded-lg font-semibold">
                    <i class="fas fa-check mr-2"></i>
                    Sudah Dibaca
                </span>
                @endif
                <a href="{{ route('admin.contacts.index') }}" 
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Sender Information -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Pengirim</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-700">Nama</p>
                    <p class="text-lg text-gray-900">{{ $contact->name }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700">Email</p>
                    <p class="text-lg text-gray-900">
                        <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                            {{ $contact->email }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Isi Pesan</h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $contact->message }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <p>Pesan diterima: {{ $contact->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        <i class="fas fa-reply mr-2"></i>
                        Balas Email
                    </a>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-semibold">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation to Other Messages -->
    <div class="mt-6 flex justify-between">
        @php
            $prevContact = \App\Models\Contact::where('id', '<', $contact->id)->orderBy('id', 'desc')->first();
            $nextContact = \App\Models\Contact::where('id', '>', $contact->id)->orderBy('id', 'asc')->first();
        @endphp
        
        @if($prevContact)
        <a href="{{ route('admin.contacts.show', $prevContact) }}" 
           class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left"></i>
            <span>Pesan Sebelumnya</span>
        </a>
        @else
        <div></div>
        @endif

        @if($nextContact)
        <a href="{{ route('admin.contacts.show', $nextContact) }}" 
           class="flex items-center space-x-2 text-blue-600 hover:text-blue-800">
            <span>Pesan Selanjutnya</span>
            <i class="fas fa-arrow-right"></i>
        </a>
        @endif
    </div>
</div>
@endsection