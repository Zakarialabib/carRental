<div x-data="bookingCalendar()" x-init="init()" class="flex flex-col lg:flex-row">
    <div class="lg:w-1/2 p-4">
        <div class="mb-4">
            <label for="start_date" class="block font-medium mb-2">Start Date:</label>
            <input x-ref="startDate" type="text" name="start_date" class="form-input w-full" wire:model="startDate"
                readonly>
        </div>

        <div class="mb-4">
            <label for="end_date" class="block font-medium mb-2">End Date:</label>
            <input x-ref="endDate" type="text" name="end_date" class="form-input w-full" wire:model="endDate"
                readonly>
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            wire:click="book">Book</button>
    </div>

    <div class="lg:w-1/2 p-4">
        <div class="mb-4">
            <label for="calendar_date" class="block font-medium mb-2">Select Date:</label>
            <input type="text" name="calendar_date" class="form-input w-full" wire:model="calendarDate" readonly>
        </div>

        <div class="mb-4">
            <label for="selected_time_slot" class="block font-medium mb-2">Select Time Slot:</label>
            <select name="selected_time_slot" class="form-select w-full" wire:model="selectedTimeSlot">
                @foreach ($availableTimeSlots as $timeSlot)
                    <option value="{{ $timeSlot }}">{{ $timeSlot }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            x-on:click="selectTimeSlot()">Select Time Slot</button>
    </div>

    <div class="flex-1 p-4">
        <div class="mb-4">
            <label for="selected_date" class="block font-medium mb-2">Selected Date:</label>
            <input type="text" name="selected_date" class="form-input w-full" wire:model="selectedDate" readonly>
        </div>

        <div class="mb-4">
            <label for="available_time_slots" class="block font-medium mb-2">Available Time Slots:</label>
            <ul class="list-disc list-inside">
                @foreach ($availableTimeSlots as $timeSlot)
                    <li>{{ $timeSlot }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
