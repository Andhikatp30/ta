@extends('layouts.app')

@section('content')

<div class="h-full bg-gray-400">
@if (session('success'))
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 transition-opacity duration-300 transform opacity-100 scale-100">
        <div class="bg-white p-6 rounded-xl shadow-2xl max-w-md w-full transform transition-transform duration-500 scale-100">
            <div class="flex items-center">
                <div class="bg-green-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="ml-3 text-green-800 font-semibold text-lg">Success</span>
            </div>
            <div class="mt-4 text-gray-600">
                <p>{{ session('success') }}</p>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closePopup('success-popup')" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition duration-300 shadow-md">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error-popup" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 transition-opacity duration-300 transform opacity-100 scale-100">
        <div class="bg-white p-6 rounded-xl shadow-2xl max-w-md w-full transform transition-transform duration-500 scale-100">
            <div class="flex items-center">
                <div class="bg-red-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <span class="ml-3 text-red-800 font-semibold text-lg">Error</span>
            </div>
            <div class="mt-4 text-gray-600">
                <p>{{ session('error') }}</p>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closePopup('error-popup')" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition duration-300 shadow-md">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

<!-- Container -->
<div class="mx-auto">
    <div class="flex justify-center px-6 py-12">
        <!-- Row -->
        <div class="w-full xl:w-3/4 lg:w-11/12 flex">
            <!-- Col -->
            <div class="w-full h-auto bg-gray-400 dark:bg-gray-800 hidden lg:block lg:w-5/6 bg-cover rounded-l-lg"
                style="background-image: url('storage/images/logo2.png'); background-repeat: no-repeat; background-size: contain; background-position: center;"></div>
            <!-- Col -->
            <div class="w-full lg:w-7/12 bg-white dark:bg-gray-700 p-5 rounded-lg lg:rounded-l-none">
                <h3 class="py-4 text-2xl text-center text-gray-800 dark:text-black">Login</h3>
                <form class="px-8 pt-6 pb-8 mb-4 bg-white dark:bg-gray-800 rounded" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-black" for="email">
                            Email
                        </label>
                        <input
                            class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            id="email"
                            type="email"
                            name="email"
                            placeholder="Email"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <div class="mb-4 md:mr-2 md:mb-0">
                            <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-black" for="password">
                                Password
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="password"
                                type="password"
                                name="password"
                                placeholder="******************"
                                required
                            />
                        </div>
                    </div>
                    <div class="mb-6 text-center">
                        <button
                            class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 dark:bg-blue-700 dark:text-white dark:hover:bg-blue-900 focus:outline-none focus:shadow-outline"
                            type="submit"
                        >
                            Login
                        </button>
                    </div>
                    <hr class="mb-6 border-t" />
                    <div class="text-center">
                        <a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
                            href="{{ route('register') }}">
                            Don't have an account? Register!
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function closePopup(popupId) {
        const popupElement = document.getElementById(popupId);
        popupElement.classList.add('opacity-0', 'scale-90');
        setTimeout(() => {
            popupElement.style.display = 'none';
        }, 300);
    }

    // Auto-hide popup after 5 seconds
    setTimeout(() => {
        const successPopup = document.getElementById('success-popup');
        const errorPopup = document.getElementById('error-popup');
        const errorsPopup = document.getElementById('errors-popup');
        
        if (successPopup) closePopup('success-popup');
        if (errorPopup) closePopup('error-popup');
        if (errorsPopup) closePopup('errors-popup');
    }, 5000);
</script>
@endsection
