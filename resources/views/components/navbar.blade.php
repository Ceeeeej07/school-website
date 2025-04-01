<div class="relative">
    <!-- Top Bar -->
    <div class="bg-green-800 text-white">
        <div class="container mx-auto px-2 py-2 flex items-center">
            <p class="flex-none">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <div class="flex-grow text-right">
                <a href="#" class="hover:text-black">Student Portal</a>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="bg-gray-300 relative">
        <nav class="flex container mx-auto items-center justify-between relative">
            <!-- Logo -->
            <a href="#" class="flex items-center">
                <img src="{{ asset('storage/icons/ANHS-2.png') }}" alt="Logo" class="h-12 w-auto">
            </a>

            <!-- Navigation Links -->
            <div class="flex space-x-6 p-6">
                <a href="#" class="hover:text-gray-700">Home</a>
                <a href="#" class="hover:text-gray-700">About</a>

                <!-- Dropdown (Academics) -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="hover:text-gray-700 flex items-center">
                        Academics
                        <svg class="w-4 h-4 ml-1 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu (Goes Below Navbar) -->
                    <div x-show="open" x-transition class="border-t-green-800 border-t-3 absolute left-0 top-full mt-6 bg-white shadow-md rounded-b-md w-40 py-2 border z-20">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Programs</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Curriculum</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Faculty</a>
                    </div>
                </div>



                <a href="#" class="hover:text-gray-700">Admissions</a>
                <a href="#" class="hover:text-gray-700">News & Events</a>
            </div>
        </nav>
    </div>
</div>
