@extends('layout.default')
@section('title', 'Tasks')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Tasks</h2>
        <p class="text-2xl text-blue-600">{{$totalTask}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Employees</h2>
        <p class="text-2xl text-green-600">{{$totalEmployees}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Projects</h2>
        <p class="text-2xl text-red-600">{{$totalProjects}}</p>
    </div>
</div>

@session('status')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <span class="">
            {{$value}}
        </span>
    </div>
@endsession

<form action="{{ route('tasks.index') }}" method="GET" class="mt-4 mb-6 max-w-2xl">
    <div class="flex">
        <span
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
            <i class="fas fa-search text-gray-500 dark:text-gray-400"></i>
        </span>
        <input type="text" id="keyword" name="keyword"
            class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
            placeholder="Task Laravel">
        <button type="submit"
            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fas fa-search text-white"></i>
        </button>
    </div>
</form>
@can('edit', \App\Models\User::class)
    <a href="{{ route('tasks.create') }}"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        <i class="fas fa-plus text-white mr-2"></i>
        Add Task
    </a>
@endcan
<div class="mt-6 mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($tasks as $task) 
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer"
            onclick="window.location='{{ route('tasks.show', $task->id) }}'">
            <div class="flex space-x-3">
                @can('edit', \App\Models\User::class)
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700"
                        onclick="event.stopPropagation();">
                        <i class="fas fa-edit"></i>
                    </a>
                @endcan
                @can('destroy', \App\Models\User::class)
                    <form action="{{route("tasks.destroy", $task->id)}}" method="POST" onsubmit="event.stopPropagation();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                @endcan
            </div>
            <h2 class="text-lg font-bold mb-2">#{{ $task->id }}: {{ $task->name }}</h2>
            <p class="flex items-center">
                <i class="fas {{ $task->status_icon }} {{ $task->status_color }}"></i>
                <span class="ml-2 {{ $task->status_color }}">{{ $task->status }}</span>
            </p>
            <p class="text-gray-700 mb-1">{{ $task->description }}</p>
            <p class="text-gray-700 mb-1">{{ $task->project->name }}</p>
            <p class="text-gray-700 mb-1">Creator: {{ $task->creator }}</p>
            <p class="text-gray-700 mb-1">Deadline: {{ $task->deadline }}</p>
        </div>
    @endforeach
</div>
{{ $tasks->links() }}
@endsection
<!-- route('tasks.edit', $task->id) -->
<!-- route('tasks.destroy', $task->id) -->