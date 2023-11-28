<div class="bravo-list-locations destinantion-block destinantion-v1 border-bottom border-color-8 mt-6">
    <div class="container space-bottom-1">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mt-4">
            <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title}}</h2>
        </div>
        <div class="row mb-1">
            @if(!empty($rows))
                @foreach($rows as $key=>$row)
                    @php
                        $class = "col-md-6 col-xl-3 mb-3 mb-md-4";
                            if($key == 0 or $key == 5){
                                $class = "col-md-6 mb-3 mb-md-4";
                            }
                    @endphp
                    <div class="{{ $class }}">
                        @include('Location::frontend.blocks.list-locations.loop')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
