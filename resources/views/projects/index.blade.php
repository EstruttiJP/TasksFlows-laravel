@extends('layout.default')
@section('title', 'Projects')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Projects</h2>
        <p class="text-2xl text-blue-600">{{$totalProjects}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Employees</h2>
        <p class="text-2xl text-green-600">{{$totalEmployees}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Tasks</h2>
        <p class="text-2xl text-red-600">{{$totalTask}}</p>
    </div>
</div>

@session('status')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <span class="">
            {{$value}}
        </span>
    </div>
@endsession

<form action="{{ route('projects.index') }}" method="GET" class="mt-4 mb-6 max-w-2xl">
    <div class="flex">
        <span
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
            <i class="fas fa-search text-gray-500 dark:text-gray-400"></i>
        </span>
        <input type="text" id="keyword" name="keyword"
            class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
            placeholder="Projeto Laravel">
        <button type="submit"
            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fas fa-search text-white"></i>
        </button>
    </div>
</form>
@can('edit', \App\Models\User::class)
    <a href="{{ route('projects.create') }}"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        <i class="fas fa-plus text-white mr-2"></i>
        Add Project
    </a>
@endcan
<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($projects as $project) 
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="flex space-x-3">
                @can('edit', \App\Models\User::class)
                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                @can('destroy', \App\Models\User::class)
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                @endcan
            </div>
            <h2 class="text-lg font-bold mb-2">#{{$project->id}}: {{ $project->name }}</h2>
            <p class="text-gray-700 mb-1">{{ $project->description }}</p>
            <p class="text-gray-700 mb-1">{{ $project->department->name }}</p>
            <p class="text-gray-700 mb-1">Creator: {{ $project->creator }}</p>
            <p class="text-gray-700 mb-1">Deadline: {{ $project->deadline }}</p>
        </div>
    @endforeach
</div>
{{ $projects->links() }}
@endsection