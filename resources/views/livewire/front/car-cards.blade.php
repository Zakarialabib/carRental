<div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
    @foreach($this->cars as $car)
    <a href="#" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div>
            <div class="h-24 w-24 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                <img src="{{ asset('images'.$car->image) }}" />
            </div>

            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{ $car->name }}</h2>

            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                {{ $car->model }}
            </p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
        </svg>
    </a>
    @endforeach
</div>
</div>
