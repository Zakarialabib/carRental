<div>
    <div class="flex">
        <div class="w-1/3 bg-gray-900 p-4">
            <h2 class="text-xl font-bold mb-4 text-white">Filters</h2>

            <form wire:submit.prevent="submit">
                <!-- Brand Filter -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="brand">
                        Brand
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                            id="brand" wire:model.defer="brand">
                            <option value="">Dacia</option>
                            <option value="">Renault</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 12l-6-6h12z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Model Filter -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="modal">
                        Model
                    </label>
                    <div class="relative">
                        <label for="model">Model:</label>
                        <input type="text" wire:model.defer="model">
                    </div>
                </div>
                <!-- Location Filter -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="location">
                        Location
                    </label>
                    <div class="relative">

                        <label for="location">Location:</label>
                        <input type="text" wire:model.defer="location">
                    </div>
                </div>
                <!-- Price Filter -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="price">
                        Price Range
                    </label>
                    <div class="flex items-center">
                        <span class="text-white mr-2">$</span>
                        <input type="range" class="w-full" id="price" name="price" min="0"
                            max="1000">
                        <span class="text-white ml-2">$1000</span>
                    </div>
                </div>

                <!-- Date Filter -->
                <div class="mb-4">
                    <label class="block text-white font-bold mb-2" for="dates">
                        Dates
                    </label>
                    <input type="text" id="dates" name="dates"
                        class="w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <script>
                        flatpickr('#dates', {
                            enableTime: true,
                            dateFormat: "Y-m-d H:i",
                        });
                    </script>
                </div>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    type="submit">Search</button>
            </form>

        </div>

        <!-- Car Results -->
        <div class="w-2/3 p-4">
            <ul>
                @foreach ($cars as $car)
                    <li>{{ $car->make }} {{ $car->model }} - {{ $car->location }} - ${{ $car->price }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
