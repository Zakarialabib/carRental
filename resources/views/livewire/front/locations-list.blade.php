<div class="flex">
    <div class="w-1/3 pr-4" x-data="{ isFilterSidebarOpen: true }">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Locations</h2>
            <button type="button" class="text-gray-500 hover:text-gray-600"
                @click="isFilterSidebarOpen = !isFilterSidebarOpen">
                filters
            </button>
            <ul>
                @foreach ($locations as $location)
                    <li class="mb-2"><a href="#">{{ $location->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="w-2/3">
            <h2 class="text-lg font-bold mb-4">Filter</h2>

            <form wire:submit.prevent>
                <div class="mb-4">
                    <label class="block font-bold mb-2" for="parent_id">Parent Location:</label>
                    <select id="parent_id" class="w-full p-2 border rounded" wire:model="parent_id">
                        <option value="">All Locations</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2" for="latitude">Latitude:</label>
                    <input type="text" id="latitude" class="w-full p-2 border rounded" wire:model="latitude">
                </div>

                <div class="mb-4">
                    <label class="block font-bold mb-2" for="longitude">Longitude:</label>
                    <input type="text" id="longitude" class="w-full p-2 border rounded" wire:model="longitude">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Filter
                    </button>
                    <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                        wire:click="resetFilters">
                        Reset Filters
                    </button>
                </div>
            </form>

            <div class="w-65">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-medium mb-4">Cars in Range</h2>
                    <div class="flex items-center">
                        <span class="mr-2 font-medium text-gray-600 text-sm">Sort by:</span>
                        <select
                            class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option>Price (Low to High)</option>
                            <option>Price (High to Low)</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($cars as $car)
                        <div class="bg-white rounded-lg shadow-md">
                            <img src="{{ $car->image }}" alt="{{ $car->name }}" class="rounded-t-lg w-full">
                            <div class="p-4">
                                <h3 class="font-medium text-lg">{{ $car->name }}</h3>
                                <p class="text-gray-600 mt-2">{{ $car->description }}</p>
                                <p class="font-medium text-gray-600 mt-2">${{ $car->price }} per day</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Car List -->
        </div>
    </div>
</div>
