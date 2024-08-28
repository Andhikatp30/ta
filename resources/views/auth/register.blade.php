@extends('layouts.app')

@section('content')
<!-- <div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        @if ($errors->any())
            <div class="mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" class="w-full p-2 border rounded-lg" required autofocus>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" class="w-full p-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="w-full p-2 border rounded-lg" required>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-2 border rounded-lg" required>
            </div>
            <div class="mb-4 flex justify-between items-center">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Register</button>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div> -->
<div class="h-full bg-gray-400">
@if (session('success'))
    <div id="success-popup" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.707 4.293a1 1 0 00-1.414 0L10 9.586 6.707 6.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l6-6a1 1 0 000-1.414z"/>
                </svg>
                <span class="text-green-700 font-semibold">Success!</span>
            </div>
            <div class="mt-4">
                <p>{{ session('success') }}</p>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closePopup('success-popup')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error-popup" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M8.257 3.099c.366-.446 1.077-.513 1.59-.131l.094.083 7 7a1 1 0 01-1.32 1.497l-.094-.083L9 5.415 2.757 11.657a1 1 0 01-1.32-1.497l.094-.083 7-7z"/>
                </svg>
                <span class="text-red-700 font-semibold">Error:</span>
            </div>
            <div class="mt-4">
                <p>{{ session('error') }}</p>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closePopup('error-popup')" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div id="errors-popup" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M8.257 3.099c.366-.446 1.077-.513 1.59-.131l.094.083 7 7a1 1 0 01-1.32 1.497l-.094-.083L9 5.415 2.757 11.657a1 1 0 01-1.32-1.497l.094-.083 7-7z"/>
                </svg>
                <span class="text-red-700 font-semibold">Error:</span>
            </div>
            <div class="mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-6 text-right">
                <button onclick="closePopup('errors-popup')" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
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
				<div class="w-full h-auto bg-gray-400 dark:bg-gray-800 hidden lg:block lg:w-5/7 bg-cover rounded-l-lg"
					style="background-image: url('storage/images/logo2.png')"></div>
				<!-- Col -->
				<div class="w-full lg:w-7/12 bg-white dark:bg-gray-700 p-5 rounded-lg lg:rounded-l-none">
					<h3 class="py-4 text-2xl text-center text-gray-800 dark:text-black">Create an Account!</h3>
					<form class="px-8 pt-6 pb-8 mb-4 bg-white dark:bg-gray-800 rounded" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
							<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-black" for="name">
                                Name
                            </label>
							<input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="name"
                                type="text"
                                name="name"
                                placeholder="name"
                                required autofocus
                            />
						</div>
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
						<div class="mb-4 md:flex md:justify-between">
							<div class="mb-4 md:mr-2 md:mb-0">
								<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-black" for="password">
                                    Password
                                </label>
								<input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-black border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="******************"
                                    required
                                />
								<!-- <p class="text-xs italic text-red-500">Please choose a password.</p> -->
							</div>
							<div class="md:ml-2">
								<label class="block mb-2 text-sm font-bold text-gray-700 dark:text-black" for="password_confirmation">
                                    Confirm Password
                                </label>
								<input
                                    class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 dark:text-black border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
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
                                Register Account
                            </button>
						</div>
						<hr class="mb-6 border-t" />
						<!-- <div class="text-center">
							<a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
								href="#">
								Forgot Password?
							</a>
						</div> -->
						<div class="text-center">
							<a class="inline-block text-sm text-blue-500 dark:text-blue-500 align-baseline hover:text-blue-800"
								href="{{ route('login') }}">
								Already have an account? Login!
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
        popupElement.style.opacity = '0';
        setTimeout(() => {
            popupElement.style.display = 'none';
        }, 300);
    }

    // Optional: Auto-hide popup after 5 seconds
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
