@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 transform transition-all duration-500 ease-in-out">
        <!-- Animated Header -->
        <div class="text-center animate-fade-in-down">
            <div class="mx-auto h-20 w-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full flex items-center justify-center shadow-lg mb-6 transform transition-transform duration-300 hover:scale-110">
                <i class="fas fa-futbol text-white text-2xl"></i>
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 animate-pulse">
                Futsal<span class="text-blue-600">Book</span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Sistem Booking Lapangan Futsal
            </p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 ease-in-out hover:shadow-2xl">
            <div class="px-8 py-8">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    
                    <!-- Email Input -->
                    <div class="space-y-2 transform transition-all duration-300 ease-in-out">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-envelope mr-2 text-blue-500"></i>Alamat Email
                        </label>
                        <div class="relative group">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                   class="relative block w-full px-4 py-3 pl-10 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 @error('email') border-red-500 @enderror"
                                   placeholder="masukkan email anda">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400 group-hover:text-blue-500 transition-colors duration-300"></i>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-2 transform transition-all duration-300 ease-in-out">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            <i class="fas fa-lock mr-2 text-blue-500"></i>Password
                        </label>
                        <div class="relative group">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="relative block w-full px-4 py-3 pl-10 pr-10 border border-gray-300 rounded-xl placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 group-hover:border-blue-300 @error('password') border-red-500 @enderror"
                                   placeholder="masukkan password">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400 group-hover:text-blue-500 transition-colors duration-300"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-blue-500 transition-colors duration-300">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="transform transition-all duration-300 hover:scale-105">
                        <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg transition-all duration-300 ease-in-out transform hover:shadow-xl hover:-translate-y-0.5">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-blue-300 group-hover:text-white transition-colors duration-300"></i>
                            </span>
                            Masuk ke Sistem
                        </button>
                    </div>
                </form>

                <!-- Demo Accounts -->
                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200 animate-fade-in-up">
                    <h4 class="text-sm font-medium text-blue-800 mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>Akun Demo:
                    </h4>
                    <div class="space-y-1 text-xs text-blue-700">
                        <p><strong>Admin:</strong> admin@futsal.com / password123</p>
                        <p><strong>Owner:</strong> owner@futsal.com / password123</p>
                        <p><strong>User:</strong> user@futsal.com / password123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .animate-fade-in-down { animation: fade-in-down 0.6s ease-out; }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out 0.2s both; }
    .animate-shake { animation: shake 0.5s ease-in-out; }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Add input focus effects
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-200');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-200');
            });
        });
    });
</script>
@endsection