<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;

class Reviews extends Component
{
    public $reviews;
    
    protected $rules = [
        'review' => 'required|min:10',
        'rating' => 'required|integer|min:1|max:5',
    ];

    public function mount()
    {
        $this->reviews = $this->car->reviews;
    }

    public function submitReview()
    {
        $this->validate();

        $review = new Review();
        $review->user_id = Auth::id();
        $review->car_id = $this->car->id;
        $review->review = $this->review;
        $review->rating = $this->rating;
        $review->save();

        session()->flash('message', 'Review submitted successfully.');
    }
    
    public function setSelectedService($serviceId)
    {
        $this->selectedService = $this->services->where('id', $serviceId)->first();
    }

    public function render()
    {
        return view('livewire.front.reviews');
    }
}
