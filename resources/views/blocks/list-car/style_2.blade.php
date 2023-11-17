<div class="bravo-list-car">
    <div class="container space-1">
        @if(!empty($title))
            <div class="w-md-80 w-lg-50 text-center mx-md-auto mt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title}}</h2>
            </div>
        @endif

        <div class="travel-slick-carousel u-slick u-slick--equal-height u-slick--gutters-3 mb-4 pb-1"
             data-arrows-classes="d-lg-inline-block u-slick__arrow-classic u-slick__arrow-classic--v2 u-slick__arrow-centered--y rounded-circle"
             data-arrow-left-classes="flaticon-back u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-xl-n8"
             data-arrow-right-classes="flaticon-next u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-xl-n8"
             data-infinite="true"
             data-slides-show="4"
             data-slides-scroll="4"
             data-center-mode="false"
             data-pagi-classes="text-center u-slick__pagination mt-5 mb-0"
             data-responsive='[{
                        "breakpoint": 1025,
                        "settings": {
                        "slidesToShow": 3,
                        "slidesToScroll":3
                    }
                    }, {
                        "breakpoint": 992,
                        "settings": {
                        "slidesToShow": 2,
                        "slidesToScroll":2
                    }
                    }, {
                        "breakpoint": 768,
                        "settings": {
                        "slidesToShow": 1,
                        "slidesToScroll":1,
                        "dots": false
                    }
                    }]'>
            @foreach($rows as $row)
                <div class="item mt-5">
                    @include('Car::frontend.layouts.search.loop-grid')
                </div>
            @endforeach
        </div>
    </div>
</div>
