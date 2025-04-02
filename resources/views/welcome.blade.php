<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antipas National High School</title>
    <link rel="shortcut icon" href="{{ asset('storage/icons/ANHS.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles -->
    @vite('resources/css/app.css')

</head>
<body>
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="w-full h-full bg-cover bg-center blur-[2px] scale-110" style="background-image: url('{{ asset('storage/images/Teachers2.jpg') }}')"></div>
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <div class="relative z-10">
        <x-navbar />
        <x-slider />

        <div class="container mx-auto px-4 bg-gray-100">
            <!-- Section Header -->
            <div class="section-header text-center mb-12">
                <h2 class="text-3xl font-bold mb-2 text-indigo-700">School Updates</h2>
                <div class="w-24 h-1 bg-yellow-500 mx-auto"></div>
                <p class="mt-4 text-gray-600">Stay updated with the latest happenings at Antipas National High School</p>
            </div>
            <!-- Two-column Layout -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Left Column -->
                <div class="w-full md:w-2/3">
                    @livewire('news')
                </div>

                <!-- Right Column -->
                <div class="w-full md:w-1/3 bg-white rounded-lg shadow-lg p-6">
                    @livewire('awards')
                </div>
            </div>
        </div>


</body>
</html>
