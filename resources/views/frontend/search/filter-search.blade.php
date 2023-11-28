<div class="bravo_filter navbar-expand-lg navbar-expand-lg-collapse-block">
    <button class="btn d-lg-none mb-5 p-0 collapsed" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-caret-square-o-down text-primary font-size-20 card-btn-arrow ml-0 font-weight-normal"></i>
        <span class="text-primary ml-2">{{ __('Filter Search') }}</span>
    </button>
    <div id="sidebar" class="navbar-expand-lg navbar-expand-lg-collapse-block collapse">
        {{--Form Search--}}
        <div class="item pb-4 mb-2">
            @include('Car::frontend.layouts.search.form-search-vertical')
        </div>
        {{--Map--}}
        <div class="item pb-4 mb-2">
            <a href="{{ route("car.search",['_layout'=>'map']) }}" class="d-block border border-color-1 rounded-xs">
                <img src="{{ url("/themes/mytravel/images/map.jpg") }}" alt="" width="100%">
            </a>
        </div>
        <form action="{{url(app_get_locale(false,false,'/').config('car.car_route_prefix'))}}" class="bravo_form_filter">
            @if( !empty(Request::query('location_id')) )
                <input type="hidden" name="location_id" value="{{Request::query('location_id')}}">
            @endif
            @if( !empty(Request::query('start')) and !empty(Request::query('end')) )
                <input type="hidden" value="{{Request::query('start',date("d/m/Y",strtotime("today")))}}" name="start">
                <input type="hidden" value="{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}" name="end">
                <input type="hidden" name="date" value="{{Request::query('date')}}">
            @endif
            {{--Filter--}}
            <div class="sidenav border border-color-8 rounded-xs">
                <div id="bravo-filter-price" class="accordion shadow-none bravo-filter-price border-bottom">
                    <?php
                    $price_min = $pri_from = floor(App\Currency::convertPrice($car_min_max_price[0]));
                    $price_max = $pri_to = ceil(App\Currency::convertPrice($car_min_max_price[1]));
                    if (!empty($price_range = Request::query('price_range'))) {
                        $pri_from = explode(";", $price_range)[0];
                        $pri_to = explode(";", $price_range)[1];
                    }
                    $currency = App\Currency::getCurrency(App\Currency::getCurrent());
                    ?>
                    <div class="border-0">
                        <div class="card-collapse">
                            <h3 class="mb-0">
                                <button type="button" class="btn btn-link btn-block card-btn py-2  text-lh-3 collapsed" data-toggle="collapse" data-target="#context-filter-price" aria-expanded="false" aria-controls="context-filter-price">
                                    <span class="row align-items-center">
                                        <span class="col-9">
                                            <span class="d-block font-size-lg-15 font-size-17 font-weight-bold text-dark">{{ __("Price Range") }} ({{$currency['symbol'] ?? ''}})</span>
                                        </span>
                                        <span class="col-3 text-right">
                                            <span class="card-btn-arrow">
                                                <span class="fa fa-chevron-down small"></span>
                                            </span>
                                        </span>
                                    </span>
                                </button>
                            </h3>
                        </div>
                        <div id="context-filter-price" class="collapse show" data-parent="#bravo-filter-price">
                            <div class="card-body pt-0 ">
                                <div class="pb-3 mb-1 d-flex text-lh-1">
                                    <span>{{$currency['symbol'] ?? ''}}</span>
                                    <span id="rangeSliderMinResult"></span>
                                    <span class="mx-0dot5"> — </span>
                                    <span>{{$currency['symbol'] ?? ''}}</span>
                                    <span id="rangeSliderMaxResult"></span>
                                </div>
                                <input class="filter-price" type="text" name="price_range"
                                       data-extra-classes="u-range-slider height-35"
                                       data-type="double"
                                       data-grid="false"
                                       data-hide-from-to="true"
                                       data-min="{{$price_min}}"
                                       data-max="{{$price_max}}"
                                       data-from="{{$pri_from}}"
                                       data-to="{{$pri_to}}"
                                       data-prefix="{{$currency['symbol'] ?? ''}}"
                                       data-result-min="#rangeSliderMinResult"
                                       data-result-max="#rangeSliderMaxResult">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion rounded-0 shadow-none">
                    <div class="border-0">
                        <div class="card-collapse">
                            <h3 class="mb-0">
                                <button type="button" class="btn btn-link btn-block card-btn py-2  text-lh-3 collapsed" data-toggle="collapse" data-target="#review_score">
                                    <span class="row align-items-center">
                                        <span class="col-9">
                                            <span class="d-block font-size-lg-15 font-size-17 font-weight-bold text-dark text-lh-1dot4">{{ __("Review Score") }}</span>
                                        </span>
                                        <span class="col-3 text-right">
                                            <span class="card-btn-arrow">
                                                <span class="fa fa-chevron-down small"></span>
                                            </span>
                                        </span>
                                    </span>
                                </button>
                            </h3>
                        </div>
                        <div id="review_score" class="collapse show">
                            <div class="card-body pt-0 mt-1 ">
                                @for ($number = 5 ;$number >= 2 ; $number--)
                                    <div class="form-group font-size-14 text-lh-md text-secondary mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="review_score{{$number}}" name="review_score[]" type="checkbox" value="{{$number}}" @if(  in_array($number , request()->query('review_score',[])) )  checked @endif>
                                            <label class="custom-control-label text-lh-inherit text-color-1" for="review_score{{$number}}">
                                                <div class="d-inline-flex align-items-center font-size-13 text-lh-1 text-primary">
                                                    <div class="green-lighter ml-1 letter-spacing-2">
                                                        @for ($review_score = 1 ;$review_score <= $number ; $review_score++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $selected = (array) Request::query('terms');
                @endphp
                @foreach ($attributes as $item)
                    @if(empty($item['hide_in_filter_search']))
                        @php
                            $translate = $item->translate();
                        @endphp
                        {{--Term--}}
                        <div id="attr_{{$item->id}}" class="accordion rounded-0 shadow-none border-top">
                            <div class="border-0">
                                <div class="card-collapse" id="cityCategoryHeadingOne">
                                    <h3 class="mb-0">
                                        <button type="button" class="btn btn-link btn-block card-btn py-2 text-lh-3 collapsed" data-toggle="collapse" data-target="#attr_more_{{$item->id}}" aria-expanded="false" aria-controls="attr_more_{{$item->id}}">
                                            <span class="row align-items-center">
                                                <span class="col-9">
                                                    <span class="font-weight-bold font-size-17 text-dark mb-3">{{$translate->name}}</span>
                                                </span>
                                                <span class="col-3 text-right">
                                                    <span class="card-btn-arrow">
                                                        <span class="fa fa-chevron-down small"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </button>
                                    </h3>
                                </div>
                                <div id="attr_more_{{$item->id}}" class="collapse show" aria-labelledby="cityCategoryHeadingOne" data-parent="#attr_{{$item->id}}">
                                    <div class="card-body pt-0 mt-1  pb-4">
                                        @foreach($item->terms as $key => $term)
                                            @if($key <= 2 )
                                                @php $translate = $term->translate(); @endphp
                                                <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input id="term_{{$term->id}}" class="custom-control-input" @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                                                        <label class="custom-control-label" for="term_{{$term->id}}">{!! $translate->name !!}</label>
                                                    </div>
                                                    <span>{{$term->car_count??0}}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="collapse" id="more_term_{{$term->id}}">
                                            @foreach($item->terms as $key => $term)
                                                @if($key > 2 )
                                                    @php $translate = $term->translate(); @endphp
                                                    <div class="form-group d-flex align-items-center justify-content-between font-size-1 text-lh-md text-secondary mb-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input id="term_{{$term->id}}" class="custom-control-input" @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}">
                                                            <label class="custom-control-label" for="term_{{$term->id}}">{!! $translate->name !!}</label>
                                                        </div>
                                                        <span>{{$term->car_count??0}}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <a class="link link-collapse small font-size-1 mt-2" data-toggle="collapse" href="#more_term_{{$term->id}}" role="button" aria-expanded="false" aria-controls="more_term_{{$term->id}}">
                                            <span class="link-collapse__default font-size-14">{{ __("Show all") }}</span>
                                            <span class="link-collapse__active font-size-14">{{ __("Show less") }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </form>
    </div>
</div>
