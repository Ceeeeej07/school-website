<div class="max-w-6xl mx-auto my-10 rounded-xl overflow-hidden shadow-xl">
    <!-- Slider with fixed height instead of h-screen -->
    <div x-data="{ 
        index: 0, 
        images: [
            '{{ asset('storage/images/bg1.jpg') }}',
            '{{ asset('storage/images/bg2.jpg') }}',
            '{{ asset('storage/images/bg3.jpg') }}',
        ],
        titles: ['Division Press Conference Champion', 'Walang PASOK!', 'Alumni Homecoming'],
        autoPlay: null 
    }" x-init="
        autoPlay = setInterval(() => index = (index + 1) % images.length, 4000);
        $watch('index', () => {
            clearTimeout(autoPlayRestart);
            autoPlayRestart = setTimeout(() => {
                autoPlay = setInterval(() => index = (index + 1) % images.length, 4000);
            }, 10000);
        })
    " @keydown.escape="clearInterval(autoPlay)" class="relative w-full h-[500px] overflow-hidden">

        <!-- Image slides with enhanced transitions -->
        <template x-for="(image, i) in images" :key="i">
            <div :class="{ 
                'opacity-0 translate-x-full': index !== i, 
                'opacity-100 translate-x-0': index === i 
            }" class="absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out">

                <!-- Image with zoom effect -->
                <img :src="image" class="absolute inset-0 object-cover w-full h-full transform transition-transform duration-5000 ease-out" :class="index === i ? 'scale-105' : 'scale-100'" alt="Slider image" />

                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                <!-- Text overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-8 transform transition-all duration-1000 ease-out" :class="index === i ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                    <h2 x-text="titles[i]" class="text-3xl font-bold text-white mb-3"></h2>
                    <p class="text-white/90 max-w-lg text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae</p>
                    <button class="mt-4 px-5 py-2 bg-white text-gray-900 font-semibold rounded-md hover:bg-gray-200 transition text-sm">Learn More</button>
                </div>
            </div>
        </template>

        <!-- Navigation indicators -->
        <div class="absolute bottom-6 right-6 flex space-x-2 z-10">
            <template x-for="(image, i) in images" :key="i">
                <button @click="index = i; clearInterval(autoPlay)" :class="{ 'w-8 bg-white': index === i, 'w-2 bg-white/50': index !== i }" class="h-2 rounded-full transition-all duration-300 hover:bg-white/80"></button>
            </template>
        </div>

        <!-- Arrow controls -->
        <button @click="index = (index - 1 + images.length) % images.length; clearInterval(autoPlay)" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/30 text-white flex items-center justify-center backdrop-blur-sm hover:bg-black/50 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>

        <button @click="index = (index + 1) % images.length; clearInterval(autoPlay)" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/30 text-white flex items-center justify-center backdrop-blur-sm hover:bg-black/50 transition z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>
</div>
