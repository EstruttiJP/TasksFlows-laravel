@extends('layout.default')
@section('title', 'Task: ' . $task->name)
@section('content')
<button class="mb-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 focus:outline-none"
    onclick="window.history.back();">
    <i class="fas fa-reply"></i> voltar
</button>
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="mb-4 pb-2 border-b border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800">{{$task->name}}</h2>
    </div>
    <div class="space-y-4">
        <p class="{{ $task->status_color }}">
            <i class="fas {{ $task->status_icon }} mr-2"></i>Status: {{$task->status}}
        </p>
        <p class="text-gray-700"><i class="fas fa-info-circle mr-2"></i>{{$task->description}}</p>
        <p class="text-gray-700"><i class="fas fa-user mr-2"></i>Creator: {{$task->creator}}</p>
        <p class="text-gray-700"><i class="fas fa-folder-open mr-2"></i>Project: <a href="#"
                class="text-blue-500 hover:text-blue-700 underline mr-2">{{$task->project->name}}</a></p>
        <p class="text-gray-700">
            <i class="fas fa-users mr-2"></i>
            Members:
            @foreach ($task->users as $user){{ $user->name }}@if (!$loop->last),@endif
            @endforeach
        </p>
        <p class="text-gray-700"><i class="fas fa-calendar-alt mr-3"></i>Created at: {{$created_at}}</p>
        <p class="text-gray-700"><i class="fas fa-clock mr-2"></i>Deadline: {{$deadline}}</p>
    </div>
    <div class="space-y-4 max-h-64 mt-8 overflow-auto scrollbar-custom">
        @foreach ($comments as $comment)
            <div class="bg-gray-50 p-2 rounded-lg shadow-md flex items-start">
                <i class="fas fa-user-circle mr-3 text-gray-500 fa-2x"></i>
                <div>
                    <h4 class="font-semibold text-gray-800">{{ $comment->user->name }}</h4>
                    <p class="text-gray-700">{{ $comment->comment }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <div class="flex space-x-4 max-h-12 mt-4">
            <input type="text" name="comment"
                class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full text-sm p-2.5"
                placeholder="Make a comment" value="{{ old('comment') }}">
            <button type="submit"
                class="bg-blue-500 text-white px-3 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-paper-plane"></i> Enviar
            </button>
        </div>
    </form>
</div>
@endsection