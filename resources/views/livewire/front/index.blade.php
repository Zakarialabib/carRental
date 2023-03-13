<div>
    <div class="max-w-7xl mx-auto h-auto p-6 lg:p-8 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        <div class="my-16">
            <livewire:front.car-cards />
        </div>
    </div>
    <div>
    @foreach($this->sections as $section)
        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                <div class="flex items-center gap-4">
                    <a href="#"
                        class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        {{ $section->title }}
                    </a>
                </div>
            </div>

            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                {{ $section->description }}
            </div>
        </div>
        @endforeach
    </div>
</div>
