@extends('admin.layouts.app')

@section('title', 'Kelola Pesan')
@section('header', 'Kelola Pesan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Daftar Pesan</h2>
    <p class="text-gray-600">Kelola semua pesan yang diterima dari pengunjung</p>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="p-6">
        @if($contacts->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Pengirim</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Subjek</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($contacts as $contact)
                    <tr class="hover:bg-gray-50 {{ !$contact->read ? 'bg-blue-50' : '' }}">
                        <td class="px-4 py-3">
                            @if(!$contact->read)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-envelope mr-1"></i>
                                Baru
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-envelope-open mr-1"></i>
                                Terbaca
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-600">{{ $contact->email }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900">{{ $contact->subject }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($contact->message, 70) }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-gray-900">{{ $contact->created_at->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $contact->created_at->format('H:i') }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.contacts.show', $contact) }}" 
                                   class="text-blue-600 hover:text-blue-800"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$contact->read)
                                <form action="{{ route('admin.contacts.markAsRead', $contact) }}" 
                                      method="POST" 
                                      class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-800"
                                            title="Tandai Sudah Dibaca">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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

        <!-- Stats Summary -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-2xl font-bold text-blue-600">{{ $contacts->count() }}</p>
                    <p class="text-sm text-gray-600">Total Pesan</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-green-600">{{ $contacts->where('read', true)->count() }}</p>
                    <p class="text-sm text-gray-600">Telah Dibaca</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600">{{ $contacts->where('read', false)->count() }}</p>
                    <p class="text-sm text-gray-600">Belum Dibaca</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-purple-600">{{ $contacts->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                    <p class="text-sm text-gray-600">7 Hari Terakhir</p>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-envelope-open-text text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada pesan</p>
            <p class="text-gray-400 mt-2">Pesan dari pengunjung akan muncul di sini</p>
        </div>
        @endif
    </div>
</div>
@endsection