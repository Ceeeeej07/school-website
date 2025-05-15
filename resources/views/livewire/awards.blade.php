<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>

    <h3 class="text-2xl font-bold mb-4 text-black border-b border-gray-200 pb-2">Recent Awards</h3>

    <!-- Award Item 1 -->
    <div class="award-item mb-6">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0 w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <h4 class="ml-3 text-lg font-semibold text-gray-800">Best in Mathematics</h4>
        </div>
        <p class="text-gray-600 text-sm ml-15">Regional Mathematics Olympiad 2025</p>
    </div>

    <!-- Award Item 2 -->
    <div class="award-item mb-6">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            <h4 class="ml-3 text-lg font-semibold text-gray-800">Science Research Award</h4>
        </div>
        <p class="text-gray-600 text-sm ml-15">National Science Congress 2025</p>
    </div>

    <!-- Award Item 3 -->
    <div class="award-item mb-6">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                </svg>
            </div>
            <h4 class="ml-3 text-lg font-semibold text-gray-800">Cultural Excellence</h4>
        </div>
        <p class="text-gray-600 text-sm ml-15">Provincial Arts Festival 2025</p>
    </div>

    <!-- Award Item 4 -->
    <div class="award-item">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                </svg>
            </div>
            <h4 class="ml-3 text-lg font-semibold text-gray-800">Sports Champions</h4>
        </div>
        <p class="text-gray-600 text-sm ml-15">Regional Basketball Tournament 2025</p>
    </div>

    <!-- View All Awards Button -->
    <div class="mt-6">
        <a href="#" class="inline-block w-full text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition duration-300 text-sm">
            View All Awards
        </a>
    </div>


</div>
