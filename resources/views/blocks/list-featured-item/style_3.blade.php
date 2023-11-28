@if($list_item)
    <div class="bravo-featured-item {{$style ?? ''}} @if(empty($border_none)) border-bottom @endif">
        <div class="container space-1">
            @if(!empty($title))
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 pt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold">{{ $title ?? '' }}</h2>
            </div>
            @endif
            <div class="row">
                @foreach($list_item as $item)
                    <div class="col-md-4">
                        <div class="media pr-xl-14">
                            <i class="{{ $item['icon'] }} text-primary font-size-50 text-lh-1 mb-3 mr-3"></i>
                            <div class="media-body">
                                <h5 class="font-size-19 text-dark font-weight-bold mb-1">
                                    <a href="{{ $item['link'] ?? '#' }}">{{ $item['title'] ?? '' }}</a>
                                </h5>
                                <p class="text-gray-1 text-lh-inherit">{{ $item['sub_title'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
