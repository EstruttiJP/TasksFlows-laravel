@extends('layout.default')
@section('title', 'Task: {{$task->name}}')
@section('content')
<div class="flex align-center justify-center">
    <div class="p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow hover:shadow-lg transition-shadow w-full max-w-3xl">
        <h2 class="text-lg font-semibold">#{{$task->id}}: {{$task->name}}</h2>
        @session('status')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="">
                    {{$value}}
                </span>
            </div>
        @endsession
        <p class="text-gray-700 mb-1">{{ $task->description }}</p>
        <p class="text-gray-700 mb-1">{{ $task->project->name }}</p>
        @if($task->users->isEmpty())
            <p>No employees assigned to this task.</p>
        @else
            <ul>
                @foreach($task->users as $user) 
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        @endif
        <p class="text-gray-700 mb-1">Creator: {{ $task->creator }}</p>
        <p class="text-gray-700 mb-1">Deadline: {{ $task->deadline }}</p>
    </div>


    @endsection