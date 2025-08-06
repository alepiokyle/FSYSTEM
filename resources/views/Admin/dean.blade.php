@extends('layouts.admin')

@section('content')
    <main class="flex-1 px-10 py-8 bg-gray-900 text-gray-100 rounded-lg shadow-sm">
        <h2 class="text-2xl font-semibold mb-6">Register Dean Account</h2>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.deans.store') }}" class="bg-gray-800 p-6 rounded shadow-md max-w-md space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Dean Name</label>
                <input type="text" name="name" id="name" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Dean Email</label>
                <input type="email" name="email" id="email" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Temporary Password</label>
                <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Register Dean
            </button>
        </form>
    </main>
@endsection
