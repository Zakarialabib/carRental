<div class="{{ (!empty($bg_gradient)) ? str_replace('_','-',$bg_gradient) : '' }} bravo-call-to-action banner-block banner-v1 bg-img-hero space-3 {{$style}}" @if(!empty($bg_image_url)) style="background-image: url({{ $bg_image_url ?? "" }}) !important;" @endif>
    <div class="container">
        <div class="mx-auto text-center mt-xl-5 mb-xl-2 px-3 px-md-0">
            <h6 class="text-white font-size-40 font-weight-bold mb-1">{{ $title }}</h6>
            <p class="text-white font-size-18 font-weight-normal mb-4 pb-1 px-md-3 px-lg-0">
                {{$sub_title}}
            </p>
            @if($link_title)
                <a class="btn btn-outline-white border-width-2 rounded-xs min-width-200 font-weight-normal transition-3d-hover" href="{{$link_more}}">
                    {{$link_title}}
                </a>
            @endif
        </div>
    </div>
</div>
