<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full text-center">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <i class="fas fa-exclamation-triangle text-6xl text-yellow-500 mb-6"></i>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-gray-600 mb-6">
                Maaf, halaman yang Anda cari tidak ditemukan. Mungkin halaman telah dipindahkan atau dihapus.
            </p>
            <div class="space-y-4">
                <a href="{{ url('/') }}" 
                   class="block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Homepage
                </a>
                <a href="javascript:history.back()" 
                   class="block bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>
</body>
</html>