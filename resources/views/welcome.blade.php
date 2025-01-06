<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tailwind CSS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-100 overflow-hidden h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-800 flex justify-between items-center absolute top-0 w-full h-16">
        <div class="text-white text-lg font-semibold ml-3">
            <i class="fas fa-home mr-2"></i>
            Admin LTE
        </div>
        <div class="relative dropdown">
            <button class="text-white focus:outline-none mr-8">
                <i class="fas fa-user mr-2"></i>
                User <span class="caret"></span>
            </button>
        </div>
    </nav>

    <div class="flex h-full pt-16"> <!-- Adicionamos padding-top para evitar sobreposição do navbar -->
        <!-- Sidebar -->
        <aside class="bg-gray-900 w-64 h-full flex-shrink-0">
            <div class="text-white p-4">Menu</div>
            <ul class="mt-2">
                <li class="text-gray-300 hover:bg-gray-700">
                    <a href="#" class="flex items-center p-2">
                        <i class="fas fa-chart-line"></i>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1 p-4 overflow-auto">
            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow">
                    <h2 class="text-lg font-semibold">Total Users</h2>
                    <p class="text-2xl text-blue-600">1,234</p>
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
            <div class="mt-4">
                <h2 class="text-xl font-semibold">User List</h2>
                <table class="min-w-full bg-white border border-gray-300 mb-4">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Id</th>
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            {{ $users->links() }}
        </main>
    </div>
</body>

</html>
