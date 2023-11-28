@if($list_item)
    <div class="bravo-featured-item {{$style ?? ''}} @if(empty($border_none)) border-bottom @endif">
        <div class="container text-center space-1">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 pt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold">{{ $title ?? '' }}</h2>
            </div>
            <div class="row">
                @foreach($list_item as $item)
                    <div class="col-md-4">
                        <i class="{{ $item['icon'] }} text-primary font-size-80 mb-3"></i>
                        <h5 class="font-size-17 text-dark font-weight-bold mb-2">
                            <a href="{{ $item['link'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h5>
                        <p class="text-gray-1 px-xl-2 px-uw-7">{{ $item['sub_title'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
