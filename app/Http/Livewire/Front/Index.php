<?php

namespace App\Http\Livewire\Front;

use App\Enums\PageType;
use App\Models\Section;
use Livewire\Component;
class Index extends Component
{
    public function getSectionsProperty()
    {
        return Section::query()
                        ->whereType(PageType::HOME)
                        ->get();
    }

}