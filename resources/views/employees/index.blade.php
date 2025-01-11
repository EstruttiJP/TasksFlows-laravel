@extends('layout.default')
@section('title', 'Employees')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Total Employees</h2>
        <p class="text-2xl text-blue-600">{{$totalEmployee}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Projects</h2>
        <p class="text-2xl text-green-600">{{$totalProject}}</p>
    </div>
    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
        <h2 class="text-lg font-semibold">Tasks</h2>
        <p class="text-2xl text-red-600">{{$totalTask}}</p>
    </div>
</div>

<!-- User List Table -->

@session('status')
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
        <span class="">
            {{$value}}
        </span>
    </div>
@endsession

<form action="{{ route('employees.index') }}" method="GET" class="mt-4 max-w-2xl">
    <div class="flex">
        <span
            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
            <i class="fas fa-search text-gray-500 dark:text-gray-400"></i>
        </span>
        <input type="text" id="keyword" name="keyword"
            class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
            placeholder="John Snow">
        <button type="submit"
            class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fas fa-search text-white"></i>
        </button>
    </div>
</form>


<div class="mt-6 overflow-hidden overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right bg-white border border-gray-300 mb-4">
        <thead class="border-b text-xs text-gray-700 uppercase">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Department</th>
                <th class="px-6 py-4">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ optional($user->department)->name }}</td>
                    <td class="px-4 py-2 text-right whitespace-nowrap">
                        @can('edit', \App\Models\User::class)
                            <a href="{{ route('employees.edit', ['user' => $user->id]) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ml-1 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                        @endcan
                        @can('destroy', \App\Models\User::class)
                            <form action="{{ route('employees.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 ml-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->links() }}
@endsection