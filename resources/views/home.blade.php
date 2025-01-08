@extends('layout.default')
@section('title', 'Admin Dashboard')
@section('content')
<main class="flex-1 p-4 overflow-auto">
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-2xl text-blue-600">{{$totalUsers}}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
            <h2 class="text-lg font-semibold">Sales</h2>
            <p class="text-2xl text-green-600">$12,345</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
            <h2 class="text-lg font-semibold">New Orders</h2>
            <p class="text-2xl text-red-600">567</p>
        </div>
    </div>

    <!-- User List Table -->
    <div class="mt-6">
        <a href="#"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <i class="fas fa-plus mr-2"></i>
            Add users
        </a>
        <table class="w-full text-sm text-left rtl:text-right bg-white border border-gray-300 mb-4 mt-4">
            <thead class="border-b text-xs text-gray-700 uppercase">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
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
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="#"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-2 mr-2 mt-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            <a href="#"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 ml-2 mr-2 mt-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                <i class="fas fa-trash-alt mr-2"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    {{ $users->links() }}
</main>
@endsection