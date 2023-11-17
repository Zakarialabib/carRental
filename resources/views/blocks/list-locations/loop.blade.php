@php
    /**
    * @var $row \Modules\Location\Models\Location
    * @var $to_location_detail bool
    * @var $service_type string
    */
    $translation = $row->translate();
    $link_location = false;
    if(is_string($service_type)){
        $link_location = $row->getLinkForPageSearch($service_type);
    }
@endphp
<div class="{{ $min_height ?? 'min-height-350'}} bg-img-hero rounded-border p-5 gradient-overlay-half-bg-gradient transition-3d-hover shadow-hover-2 border-0 dropdown"
     style="background-image: url({{$row->getImageUrl()}});">
    <div class="w-100 d-flex justify-content-between mb-2">
        <div class="position-relative">
            <a href="{{$row->getDetailUrl()}}" class="destination text-white font-weight-bold font-size-21 pb-3 mb-3 text-lh-1 d-block">
                {{$translation->name}}
            </a>
            <div class="destination-dropdown v1">
                @if(is_array($service_type))
                    <div class="desc">
                        @foreach($service_type as $type)
                            @php $count = $row->getDisplayNumberServiceInLocation($type) @endphp
                            @if(!empty($count))
                                @if(empty($link_location))
                                    <a class="dropdown-item" href="{{ $row->getLinkForPageSearch( $type ) }}" target="_blank">
                                        {{$count}}
                                    </a>
                                @else
                                    <span>{{$count}}</span>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @else
                    @if(!empty($text_service = $row->getDisplayNumberServiceInLocation($service_type)))
                        <a href="#">{{$text_service}}</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
