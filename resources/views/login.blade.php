<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="min-h-screen bg-white-100 flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-pink-200 rounded-xl shadow-lg p-12">
            <div class="mb-4 text-center">
                <img src ="img/logo.jpg" alt="Deskripsi Gambar" class="w-32 h-42 mx-auto rounded-full ">
            </div>
            <h2 class="text-2xl font-sans text-gray-900 mb-6 text-center">Kembangku Pontianak</h2>
            @error('message')
                <div class="text-red-500 bg-red-100 p-[10px] m-[10] rounded-lg">{{ $message }}</div>
            @enderror
            <form action="{{ route('user.login.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Username</label>
                    <input type="text" value="{{ old('username') }}" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="Username" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="Password" />
                </div>

                <button
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                By kembangku &copy; 2024-2025
            </div>
        </div>
    </div>
</body>

</html>
