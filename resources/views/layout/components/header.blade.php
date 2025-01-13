<!-- Navbar -->
<nav class="bg-gray-800 flex justify-between items-center absolute top-0 w-full h-24 z-30">
    <button id="menu-button" class="z-20 p-2 mr-4 text-white lg:hidden">
        <div id="line1" class="h-1 w-8 bg-white transition-transform"></div>
        <div id="line2" class="h-1 w-8 bg-white mt-1 transition-opacity"></div>
        <div id="line3" class="h-1 w-8 bg-white mt-1 transition-transform"></div>
    </button>
    <div class="text-white text-lg font-semibold ml-3">
        <img src="{{ Vite::asset('resources/images/TasksLogo.png') }}" alt="logo" class="h-20 w-20 ml-3">
    </div>

    <!-- Botão Menu Hambúrguer -->

    <div class="relative dropdown">
        <button class="text-white focus:outline-none mr-8 p-2 rounded-lg">
            <i class="fas fa-user mr-2"></i>
            <span class="caret">{{ auth()->user()->name }}</span>
        </button>
        <div id="dropdown"
            class="absolute right-6 mt-2 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block text-red-600 text-start font-semibold w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-red-400">
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>