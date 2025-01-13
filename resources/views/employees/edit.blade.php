@extends('layout.default')
@section('title', 'Edit Employee')
@section('content')
<div class="flex align-center justify-center">
    <div class="p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow hover:shadow-lg transition-shadow w-full max-w-3xl">
        <h2 class="text-lg font-semibold">{{$user->name}}</h2>
        @session('status')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="">
                    {{$value}}
                </span>
            </div>
        @endsession
        <form class="space-y-4" action="{{ route('employees.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your full
                    name</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="text" id="name" name="name"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                        placeholder="John Snow" value="{{ old('name') ?? $user->name }}">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <i class="fas fa-envelope text-gray-500"></i>
                    </span>
                    <input type="text" id="email" name="email"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                        placeholder="John@example.com" value="{{ old('email') ?? $user->email }}">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <i class="fas fa-lock text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="text" id="password" name="password"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                        placeholder="••••••••" value="{{ old('password') }}">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900">Select
                    Department</label>
                <select id="department_id" name="department_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" @selected($department->id == optional($user)->department_id)>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                <select id="role_id" name="role_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @selected(optional($user)->role_id == $role->id || $role->name == 'COMMON_USER')>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update
            </button>
        </form>
    </div>
</div>
@endsection