@if($list_item)
    <div class="bravo-featured-item {{$style ?? ''}}" style="background-image: url('{{$bg_image_url}}');">
        <div class="container text-center space-top-lg-2">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 pt-5 pb-md-6">
                <h2 class="section-title text-black font-size-30 font-weight-bold">{{ $title ?? "" }}</h2>
            </div>
            <div class="mb-6">
                <div class="row">
                    @foreach($list_item as $k=>$item)
                        <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                        <div class="col-lg-4 pb-4 pb-lg-0 px-5">
                            <img class="img-cover w-100 pb-5 radius-5 rounded shadow-hover-3" src="{{$image_url}}" alt="{{$item['title']}}">
                            <div class="text-lg-left w-100 mx-auto">
                                <h5 class="font-size-21 text-dark font-weight-bold mb-2">
                                    <a href="{{ $item['link'] ?? '#' }}">
                                        {{$item['title']}}
                                    </a>
                                </h5>
                                <p class="text-gray-1">
                                    {!! clean($item['sub_title']) !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
