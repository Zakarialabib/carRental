@if(!empty($translation->specifications) and is_array($translation->specifications))
<div class=" py-4">
    <h5 id="scroll-specifications" class="font-size-21 font-weight-bold text-dark mb-4">{{ __('Specifications') }}</h5>
    <ul class="list-group list-group-borderless list-group-horizontal list-group-flush no-gutters row">
        @foreach($translation->specifications as $item)
            <li class="col-md-4 mb-5 list-group-item py-0">
                <div class="font-weight-bold text-dark">{{ $item['name'] }}</div>
                <span class="text-gray-1">{{ $item['desc'] }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endif
