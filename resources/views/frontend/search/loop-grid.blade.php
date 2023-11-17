@php
    $translation = $row->translate();
@endphp
<div class="card transition-3d-hover shadow-hover-2 item-loop w-100 {{$wrap_class ?? ''}}">
    <div class="position-relative">
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" class="d-block gradient-overlay-half-bg-gradient-v5">
            <img class="card-img-top" src="{{$row->image_url}}" alt="{!! clean($translation->title) !!}">
        </a>
        <div class="position-absolute top-0 right-0 pt-4 pr-3 btn-wishlist">
            <button type="button" class="p-0 btn btn-sm btn-icon text-white rounded-circle service-wishlist {{$row->isWishList()}}" data-id="{{$row->id}}" data-type="{{$row->type}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __("Save for later") }}">
                <span class="flaticon-valentine-heart font-size-20"></span>
            </button>
        </div>
        <div class="position-absolute bottom-0 left-0 right-0 text-content">
            <div class="px-3 pb-2">
                <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" >
                    <span class="text-white font-weight-bold font-size-17">{!! clean($translation->title) !!}</span>
                </a>
                <div class="text-white my-2">
                    <small class="mr-1 font-size-14">{{ __("From") }}</small>
                    <small class="mr-1 font-size-13 text-decoration-line-through">
                        {{ $row->display_sale_price }}
                    </small>
                    <span class="font-weight-bold font-size-19">{{ $row->display_price }}</span>
                </div>
            </div>
        </div>
        <div class="location d-none position-absolute bottom-0 left-0 right-0">
            <div class="px-4 pb-3">
                @if(!empty($row->location->name))
                    @php $location =  $row->location->translate(); @endphp
                    <a href="{{$row->location->getDetailUrl() ?? ''}}" class="d-block">
                        <div class="d-flex align-items-center font-size-14 text-white">
                            <i class="icon flaticon-pin-1 mr-2 font-size-20"></i> {{$location->name ?? ''}}
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="position-absolute top-0 left-0 pt-4 pl-3 featured">
        @if($row->is_featured == "1")
            <span class="badge badge-pill bg-white text-primary px-4 mr-3 py-2 font-size-14 font-weight-normal">{{ __("Featured") }}</span>
        @endif
        @if($row->discount_percent)
            <span class="badge badge-pill bg-white text-danger px-3  py-2 font-size-14 font-weight-normal">{{$row->discount_percent}}</span>
        @endif
    </div>

    <div class="card-body px-3 py-3 border-bottom">
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" class="d-block location">
            <div class="d-flex align-items-center font-size-14 text-gray-1">
                @if(!empty($row->location->name))
                    @php $location =  $row->location->translate() @endphp
                    <i class="icon flaticon-placeholder mr-2 font-size-20"></i> {{$location->name ?? ''}}
                @endif
            </div>
        </a>
        <a @if(!empty($blank)) target="_blank" @endif href="{{$row->getDetailUrl($include_param ?? true)}}" class="d-none title">
            <span class="font-weight-bold font-size-17">{!! clean($translation->title) !!}</span>
        </a>
        <div class="mt-1 service-review">
            @if(setting_item('tour_enable_review'))
                @php
                    $reviewData = $row->getScoreReview();
                    $score_total = $reviewData['score_total'];
                @endphp
                <span class="py-1 font-size-14 border-radius-3 font-weight-normal pagination-v2-arrow-color rate">
                    {{ $score_total }}/5 <span class="rate-text">{{ $reviewData['review_text'] }}</span>
                </span>
                <span class="font-size-14 text-gray-1 ml-2 review">
                    @if($reviewData['total_review'] > 1)
                        {{ __(":number reviews",["number"=>$reviewData['total_review'] ]) }}
                    @else
                        {{ __(":number review",["number"=>$reviewData['total_review'] ]) }}
                    @endif
                </span>
            @endif
        </div>
        <div class="g-price d-none">
            <div class="prefix">
                <span class="fr_text">{{__("from")}}</span>
            </div>
            <div class="price">
                <span class="onsale">{{ $row->display_sale_price }}</span>
                <span class="text-price">{{ $row->display_price }}</span>
            </div>
        </div>
    </div>
    <div class="px-3 pt-3 pb-2 type-attribute">
        <div class="row">
            <div class="col-6">
                <ul class="list-unstyled mb-0">
                    <li class="media mb-2 text-gray-1 align-items-center">
                        <small class="mr-2">
                            <small class=" field-icon icon-passenger font-size-16"></small>
                        </small>
                        <div class="media-body font-size-1">
                            {{$row->passenger}} <small>{{ __("Seats") }}</small>
                        </div>
                    </li>
                    <li class="media mb-2 text-gray-1 align-items-center">
                        <small class="mr-2">
                            <small class="field-icon icon-gear font-size-16"></small>
                        </small>
                        <div class="media-body font-size-1">
                            {{$row->gear}}
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-6">
                <ul class="list-unstyled mb-0">
                    <li class="media mb-2 text-gray-1 align-items-center">
                        <small class="mr-2">
                            <small class="field-icon icon-baggage font-size-16"></small>
                        </small>
                        <div class="media-body font-size-1">
                            {{$row->baggage}} <small>{{__("Baggage")}}</small>
                        </div>
                    </li>
                    <li class="media mb-2 text-gray-1 align-items-center">
                        <small class="mr-2">
                            <small class="field-icon icon-door font-size-16"></small>
                        </small>
                        <div class="media-body font-size-1">
                            {{$row->door}} <small>{{__("Door")}}</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
