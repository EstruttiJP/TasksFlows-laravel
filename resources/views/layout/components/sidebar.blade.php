<!-- Sidebar -->
<aside id="mobile-menu"
    class="bg-gray-900 w-40 mt-24 sm:w-48 h-full absolute top-0 left-0 -translate-x-full transition-transform duration-300 z-20 lg:static lg:translate-x-0 lg:mt-8 lg:ml-0">
    <div class="text-white p-4 font-semibold">Menu</div>
    <ul>
        <li class="text-gray-300 hover:bg-gray-700">
            <a href="{{route("employees.index")}}" class="flex items-center p-2">
                <i class="fas fa-users"></i>
                <span class="ml-3">Employees</span>
            </a>
        </li>
        <li class="text-gray-300 hover:bg-gray-700">
            <a href="{{route("departments.index")}}" class="flex items-center p-2">
                <i class="fas fa-building"></i>
                <span class="ml-3">Departments</span>
            </a>
        </li>
        <li class="text-gray-300 hover:bg-gray-700">
            <a href="{{route("projects.index")}}" class="flex items-center p-2">
                <i class="fas fa-briefcase"></i>
                <span class="ml-3">Projects</span>
            </a>
        </li>
        <li class="text-gray-300 hover:bg-gray-700">
            <a href="{{route("tasks.index")}}" class="flex items-center p-2">
                <i class="fas fa-tasks"></i>
                <span class="ml-3">Tasks</span>
            </a>
        </li>
    </ul>
</aside>