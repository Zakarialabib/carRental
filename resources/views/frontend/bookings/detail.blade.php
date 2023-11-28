@php $lang_local = app()->getLocale() @endphp
@php
    $service_translation = $service->translate($lang_local);
@endphp
<div class="shadow-soft bg-white rounded-sm booking-review">
    <div class="pt-5 pb-3 px-4 border-bottom">
        <a href="#" class="d-block mb-3">
            <img class="img-fluid rounded-sm" src="{{$service->image_url}}" alt="{!! clean($service_translation->title) !!}">
        </a>
        <a href="{{$service->getDetailUrl()}}" class="text-dark font-weight-bold mb-2 d-block">
            {!! clean($service_translation->title) !!}
        </a>
        @if($service_translation->address)
            <div class="mb-1 flex-horizontal-center text-gray-1">
                <i class="icon flaticon-pin-1 mr-2 font-size-15"></i> {{$service_translation->address}}
            </div>
        @endif
    </div>
    <div id="basicsAccordionBooking">
        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapseDetail">
                        {{ __("Booking Detail") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapseDetail" class="collapse show" data-parent="#basicsAccordionBooking">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                        @if($booking->start_date)
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Start date:')}}</div>
                                <div class="val">
                                    {{display_date($booking->start_date)}}
                                </div>
                            </li>
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('End date:')}}</div>
                                <div class="val">
                                    {{display_date($booking->end_date)}}
                                </div>
                            </li>
                        @endif
                        <li class="d-flex justify-content-between py-2">
                            <div class="label">{{__('Days:')}}</div>
                            <div class="val">
                                {{$booking->duration_days}}
                            </div>
                        </li>
                        @if($meta = $booking->number)
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Number:')}}</div>
                                <div class="val">
                                    {{$meta}}
                                </div>
                            </li>
                        @endif
                        <li class="flex-wrap">
                            <div class="flex-grow-0 flex-shrink-0 w-100">
                                <p class="text-center">
                                    <a data-toggle="modal" data-target="#detailBookingDate{{$booking->code}}" aria-expanded="false"
                                       aria-controls="detailBookingDate{{$booking->code}}">
                                        {{__('Detail')}} <i class="icofont-list"></i>
                                    </a>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card rounded-0 border-top-0 border-left-0 border-right-0">
            <div class="card-header card-collapse bg-transparent border-0" id="basicsHeadingFour">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link border-0 btn-block d-flex justify-content-between card-btn py-3 px-4 font-size-17 font-weight-bold text-dark" data-toggle="collapse" data-target="#basicsCollapsePayment">
                        {{ __("Payment") }}
                        <span class="card-btn-arrow font-size-14 text-dark"><i class="fa fa-chevron-down"></i></span>
                    </button>
                </h5>
            </div>
            <div id="basicsCollapsePayment" class="collapse show">
                <div class="card-body px-4 pt-0">
                    <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                        @php
                            $price_item = $booking->total_before_extra_price;
                        @endphp
                        @if(!empty($price_item))
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__('Rental price')}}
                                </div>
                                <div class="val">
                                    {{format_money( $price_item)}}
                                </div>
                            </li>
                        @endif
                        @php $extra_price = $booking->getJsonMeta('extra_price') @endphp
                        @if(!empty($extra_price))
                            <li class="d-flex justify-content-between py-2">
                                <div class="font-size-16 font-weight-bold">
                                    {{__("Extra Prices:")}}
                                </div>
                            </li>
                            @foreach($extra_price as $type)
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{$type['name_'.$lang_local] ?? __($type['name'])}}:</div>
                                    <div class="val">
                                        {{format_money($type['total'] ?? 0)}}
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @php
                            $list_all_fee = [];
                            if(!empty($booking->buyer_fees)){
                                $buyer_fees = json_decode($booking->buyer_fees , true);
                                $list_all_fee = $buyer_fees;
                            }
                            if(!empty($vendor_service_fee = $booking->vendor_service_fee)){
                                $list_all_fee = array_merge($list_all_fee , $vendor_service_fee);
                            }
                        @endphp
                        @if(!empty($list_all_fee))
                            @foreach ($list_all_fee as $item)
                                @php
                                    $fee_price = $item['price'];
                                    if(!empty($item['unit']) and $item['unit'] == "percent"){
                                        $fee_price = ( $booking->total_before_fees / 100 ) * $item['price'];
                                    }
                                @endphp
                                <li class="d-flex justify-content-between py-2">
                                    <div class="font-size-16 font-weight-bold">
                                        {{__("Fee:")}}
                                    </div>
                                </li>
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">
                                        {{$item['name_'.$lang_local] ?? $item['name']}}
                                        <i class="icofont-info-circle" data-toggle="tooltip" data-placement="top" title="{{ $item['desc_'.$lang_local] ?? $item['desc'] }}"></i>
                                        @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                            : {{$booking->total_guests}} * {{format_money( $fee_price )}}
                                        @endif
                                    </div>
                                    <div class="val">
                                        @if(!empty($item['per_person']) and $item['per_person'] == "on")
                                            {{ format_money( $fee_price * $booking->total_guests ) }}
                                        @else
                                            {{ format_money( $fee_price ) }}
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @endif
                        @includeIf('Coupon::frontend/booking/checkout-coupon')
                        <li class="d-flex justify-content-between py-2">
                            <div class="label">{{__("Total:")}}</div>
                            <div class="val">{{format_money($booking->total)}}</div>
                        </li>
                        @if($booking->status !='draft')
                            <li class="d-flex justify-content-between py-2">
                                <div class="label">{{__("Paid:")}}</div>
                                <div class="val">{{format_money($booking->paid)}}</div>
                            </li>
                            @if($booking->paid < $booking->total )
                                <li class="d-flex justify-content-between py-2">
                                    <div class="label">{{__("Remain:")}}</div>
                                    <div class="val">{{format_money($booking->total - $booking->paid)}}</div>
                                </li>
                            @endif
                        @endif
                        @include ('Booking::frontend/booking/checkout-deposit-amount')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@php $dateDetail = $service->detailBookingEachDate($booking); @endphp
<div class="modal fade" id="detailBookingDate{{$booking->code}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">{{__('Detail')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="review-list list-unstyled">
                    <li class="mb-3 pb-1 border-bottom">
                        <h6 class="label text-center font-weight-bold mb-1"></h6>
                        <div>
                            @includeIf("Car::frontend.booking.detail-date",['rows'=>$dateDetail,'number'=>$booking->number])
                        </div>
                        <div class="d-flex justify-content-between font-weight-bold px-2">
                            <span>{{__("Total:")}}</span>
                            <span>{{format_money(array_sum(\Illuminate\Support\Arr::pluck($dateDetail,['price']))*$booking->number)}}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
