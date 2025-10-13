<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-8">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="text-center mb-8">
                <i class="fas fa-code text-blue-600 text-4xl mb-4"></i>
                <h2 class="text-3xl font-bold text-gray-900">Admin Login</h2>
                <p class="text-gray-600">Masuk ke dashboard admin</p>
            </div>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               value="{{ old('email') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="admin@example.com">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="••••••••">
                    </div>

                    <div>
                        <button type="submit" 
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="text-center text-gray-600">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Website
            </a>
        </div>
    </div>
</body>
</html>