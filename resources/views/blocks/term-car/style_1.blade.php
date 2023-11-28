@if(!empty($terms))
    <div class="bravo-list-term-car border-bottom border-color-8">
        <div class="container space-1">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mt-4">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title}}</h2>
            </div>
            <div class="row">
                @foreach($terms as $row)
                    <div class="col-md-6 col-xl-3">
                        <div class="mb-5">
                            <a class="d-block position-50-hover text-center overflow-hidden" href="{{ route('car.search',['terms' => $row['id']]) }}">
                                <div class="bg-img-hero rounded-xs bg-gray-23 min-height-200">
                                    <div class="pt-4 mb-5">
                                        <h6 class="mb-0 font-size-17 font-weight-bold text-dark-1">{{$row['name']}}</h6>
                                    </div>
                                    <img class="img-fluid position-50-horizontal" src="{{ get_file_url($row['image_id'],'full') }}" alt="{{$row['name']}}">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif


