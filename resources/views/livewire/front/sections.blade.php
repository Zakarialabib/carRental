<div>
    <div class="relative mx-auto">
        <div class="w-full mx-auto">
            @foreach ($this->sections as $section)
                <div class="flex flex-wrap h-auto px-4" id="{{ $section->id }}" wire:loading.class.delay="opacity-50"
                    wire:key="col-{{ $section->id }}"
                    style="background-image: url({{ asset('images/sections/' . $section->image) }});background-size: cover;background-position: center;
                          background-color: {{ $section->bg_color }};color:{{ $section->text_color }};">
                    <div class="w-full px-4 py-10">
                        <div class="w-full text-center lg:py-5 py-10 rounded-md px-2"
                            style="background-color: {{ $section->bg_color }};color:{{ $section->text_color }};">
                            <h5 class="text-2xl lg:text-xl sm:text-lg font-bold mb-2">
                                {{ $section->subtitle }}
                            </h5>
                            <h2 class="lg:text-6xl sm:text-xl font-semibold font-heading">
                                {{ $section->title }}
                            </h2>
                            <p class="py-10 lg:text-lg sm:text-sm">
                                {!! $section->description !!}
                            </p>
                            @if ($section->is_car)
                                <div class="grid gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 px-4 my-4">
                                    @foreach ($this->cars as $car)
                                        <x-product-card :product="$car" />
                                    @endforeach
                                </div>
                            @endif
                            @if ($section->is_form && $this->selectedCar)
                                <livewire:front.order-form :product="$car" />
                            @endif
                            @if ($section->link)
                                <a class="hover:bg-red-400 text-white font-bold font-heading p-4 rounded-full uppercase transition duration-200 bg-red-500"
                                    href="{{ $section->link }}">
                                    {!! $section->label !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>