@extends('layout.default')
@section('title', 'Edit Department')
@section('content')
<div class="flex align-center justify-center">
    <div class="p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow hover:shadow-lg transition-shadow w-full max-w-3xl">
        <h2 class="text-lg font-semibold">Register Department</h2>
        @session('status')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="">
                    {{$value}}
                </span>
            </div>
        @endsession
        <form class="space-y-4" action="{{ route('departments.store') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Department Name</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="text" id="name" name="name"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                        placeholder="John Snow" value="{{ old('name') }}">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Register
            </button>
    </div>
    </form>
</div>
@endsection