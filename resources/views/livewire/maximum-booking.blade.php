<!-- resources/views/livewire/maximum-booking.blade.php -->

<div>
    <p>Current bookings on {{ $date }}: {{ $currentBookings }}</p>
    @error('date') <p>{{ $message }}</p> @enderror
</div>
