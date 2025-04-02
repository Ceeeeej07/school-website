<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <h3 class="text-2xl font-bold mb-6 text-indigo-700">Latest News</h3>

    <!-- News Item 1 -->
    <div class="news-item bg-white rounded-lg shadow-lg overflow-hidden mb-6 transform transition duration-300 hover:shadow-xl">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <img src="{{ asset('storage/images/news/academic-excellence.jpg') }}" alt="Academic Excellence Awards" class="w-full h-48 md:h-full object-cover">
            </div>
            <div class="md:w-2/3 p-6">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        March 15, 2025
                    </div>
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">Featured</span>
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Academic Excellence Awards 2025</h3>
                <p class="text-gray-600 mb-4">Congratulations to all students who received recognition during our annual Academic Excellence Awards ceremony. The event highlighted outstanding achievements across all grade levels.</p>
                <a href="#" class="inline-block text-indigo-600 hover:text-indigo-800 font-medium">Read More →</a>
            </div>
        </div>
    </div>

    <!-- News Item 2 -->
    <div class="news-item bg-white rounded-lg shadow-lg overflow-hidden mb-6 transform transition duration-300 hover:shadow-xl">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <img src="{{ asset('storage/images/news/sports-fest.jpg') }}" alt="Intramural Sports Festival" class="w-full h-48 md:h-full object-cover">
            </div>
            <div class="md:w-2/3 p-6">
                <div class="flex items-center text-gray-500 text-sm mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    March 5, 2025
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Intramural Sports Festival Kicks Off</h3>
                <p class="text-gray-600 mb-4">The annual intramural sports competition has begun with great enthusiasm from all participating classes. Events include basketball, volleyball, track and field, and more.</p>
                <a href="#" class="inline-block text-indigo-600 hover:text-indigo-800 font-medium">Read More →</a>
            </div>
        </div>
    </div>

    <!-- News Item 3 -->
    <div class="news-item bg-white rounded-lg shadow-lg overflow-hidden mb-6 transform transition duration-300 hover:shadow-xl">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <img src="{{ asset('storage/images/news/science-fair.jpg') }}" alt="Science Fair Winners" class="w-full h-48 md:h-full object-cover">
            </div>
            <div class="md:w-2/3 p-6">
                <div class="flex items-center text-gray-500 text-sm mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    February 28, 2025
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Regional Science Fair Winners Announced</h3>
                <p class="text-gray-600 mb-4">Our students took home several awards at the Regional Science Fair. Their innovative projects impressed the judges and showcased our school's commitment to STEM education.</p>
                <a href="#" class="inline-block text-indigo-600 hover:text-indigo-800 font-medium">Read More →</a>
            </div>
        </div>
    </div>

    <!-- View All News Button -->
    <div class="text-center mt-8">
        <a href="#" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
            View All News
        </a>
    </div>
</div>
