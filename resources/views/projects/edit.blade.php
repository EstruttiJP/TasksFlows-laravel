@extends('layout.default')
@section('title', 'Update Project')
@section('content')
<div class="flex align-center justify-center">
    <div class="p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow hover:shadow-lg transition-shadow w-full max-w-3xl">
        <h2 class="text-lg font-semibold">{{$project->name}}</h2>
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="">{{ session('status') }}</span>
            </div>
        @endif
        <form class="space-y-4" action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name for Project</label>
                <div class="flex">
                    <span
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                        <i class="fas fa-briefcase text-gray-500 dark:text-gray-400"></i>
                    </span>
                    <input type="text" id="name" name="name"
                        class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                        placeholder="Project Laravel" value="{{ old('name') ?? $project->name }}">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <textarea id="description" rows="4" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Leave a description for Project...">{{ old('description') ?? $project->description }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative max-w-sm">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input id="deadline" type="text" name="deadline"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                    placeholder="Select deadline" value="{{ old('deadline') ?? $project->deadline }}">
                @error('deadline')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900">Select
                    Department</label>
                <select id="department_id" name="department_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" @selected($department->id == $project->department_id)>
                            {{ $department->name }}</option>
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