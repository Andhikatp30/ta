@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Your Profile</h2>

    @if(session('success'))
        <div id="success-message" class="bg-green-100 border border-green-200 text-green-800 p-4 rounded mb-6 flex items-center">
            <svg class="h-5 w-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 9.586 7.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="mb-5">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
            @error('name')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
            @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">New Password <span class="text-gray-400">(Optional)</span></label>
            <input id="password" type="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-5">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-150 ease-in-out">
                Update Profile
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Automatically hide the success message after 5 seconds
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 5000); // 5000ms = 5 seconds
</script>
@endsection
