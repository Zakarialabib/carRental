<div class="bravo-destination">
    <div class="container space-top-1">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mt-3">
            <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title}}</h2>
        </div>
        <div class="travel-slick-carousel u-slick u-slick--gutters-3"
             data-slides-show="4"
             data-slides-scroll="1"
             data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic v1 u-slick__arrow-classic--v1 u-slick__arrow-centered--y rounded-circle"
             data-arrow-left-classes="flaticon-back u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left"
             data-arrow-right-classes="flaticon-next u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right"
             data-pagi-classes="d-lg-none text-center u-slick__pagination mt-4"
             data-responsive='[{
                        "breakpoint": 1025,
                        "settings": {
                        "slidesToShow": 3
                        }
                        }, {
                        "breakpoint": 992,
                        "settings": {
                        "slidesToShow": 2
                        }
                        }, {
                        "breakpoint": 768,
                        "settings": {
                        "slidesToShow": 1
                        }
                        }, {
                        "breakpoint": 554,
                        "settings": {
                        "slidesToShow": 1
                        }
                        }]'>
            @if(!empty($rows))
                @foreach($rows as $row)
                    <div class="item bg-img-hero-center rounded-border min-height-350 gradient-overlay-half-bg-gradient-v1 mt-5">
                        @include('Location::frontend.blocks.list-locations.loop')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
