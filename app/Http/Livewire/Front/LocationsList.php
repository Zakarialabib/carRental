<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LocationList extends Component
{
    public $locations;
    public $parent_id;
    public $latitude;
    public $longitude;

    public function mount($parent_id = null)
    {
        $this->parent_id = $parent_id;
    }

    public function resetFilters()
    {
        $this->parent_id = null;
        $this->latitude = null;
        $this->longitude = null;
    }

    public function render()
    {
        $query = Location::query();

        // Filter by parent ID if selected
        if ($this->parent_id) {
            $locations = $locations->where('parent_id', $this->parent_id);
        }

        // Filter by distance if latitude and longitude are provided
        if ($this->latitude && $this->longitude) {
            $userLocation = new Point($this->latitude, $this->longitude);

            $locations = $locations->filter(function ($location) use ($userLocation) {
                $locationPoint = new Point($location->latitude, $location->longitude);
                $distance = $locationPoint->distance($userLocation);

                // Distance should be less than or equal to 10 kilometers
                return $distance <= 10000;
            });
        }

        $this->locations = $query->get();

        return view('livewire.front.locations-list');
    }
}
