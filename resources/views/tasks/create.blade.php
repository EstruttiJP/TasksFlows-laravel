@extends('layout.default')
@section('title', 'Create Task')
@section('content')
<div class="flex align-center justify-center">
    <div class="p-6 space-y-4 sm:p-8 bg-white rounded-lg shadow hover:shadow-lg transition-shadow w-full max-w-3xl">
        <h2 class="text-lg font-semibold">Create Task</h2>
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="">{{ session('status') }}</span>
            </div>
        @endif
        <form class="space-y-4" action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name for Task</label>
                <input type="text" id="name" name="name"
                    class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full text-sm p-2.5"
                    placeholder="Task Laravel" value="{{ old('name') }}">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                <textarea id="description" rows="4" name="description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Leave a description for Task...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="relative max-w-sm">
                <label for="deadline" class="block text-sm font-medium text-gray-700">Select Deadline</label>
                <div class="absolute mt-5 inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-calendar-alt text-gray-500 dark:text-gray-400" style="font-size: 1rem;"></i>
                </div>
                <input id="deadline" type="text" name="deadline"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 p-2.5 leading-4"
                    placeholder="Select deadline" value="{{ old('deadline') }}">
                @error('deadline')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="project_id" class="block mb-2 text-sm font-medium text-gray-900">Select Project</label>
                <select id="project_id" name="project_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label for="departments" class="block mb-2 text-sm font-medium text-gray-900">Assign Users by
                    Department</label>
                <div class="space-y-4 max-h-56 overflow-auto scrollbar-custom">
                    @foreach ($departments as $department)
                        <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                            <div class="flex justify-between items-center cursor-pointer"
                                onclick="toggleUsers('{{ $department->id }}')">
                                <h3 class="text-sm font-medium text-gray-900">{{ $department->name }}</h3>
                                <!-- Botão de toggle para exibir/ocultar os usuários -->
                                <button type="button" class="text-primary-600 focus:outline-none">
                                    <i id="icon-{{ $department->id }}" class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                            <div id="users-{{ $department->id }}"
                                class="space-y-2 mt-2 overflow-auto max-h-40 hidden scrollbar-custom">
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($department->users as $user)
                                        <label
                                            class="inline-flex items-center space-x-2 p-2 rounded-lg border border-gray-300 hover:bg-gray-200 cursor-pointer transition-all">
                                            <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                                class="form-checkbox text-primary-600" {{ in_array($user->id, old('users', [])) ? 'checked' : '' }}>
                                            <span class="text-sm text-gray-700">{{ $user->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



            <button type="submit"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Create
            </button>
        </form>
    </div>
</div>
<script>
    function toggleUsers(departmentId) {
        const usersList = document.getElementById(`users-${departmentId}`);
        const icon = document.getElementById(`icon-${departmentId}`);

        // Alternar visibilidade
        if (usersList.classList.contains('hidden')) {
            usersList.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            usersList.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>
@endsection