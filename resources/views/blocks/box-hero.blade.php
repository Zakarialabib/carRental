<div class="{{ str_replace('_','-',$bg_gradient) }} bg-img-hero text-center mb-1" style="background-image: url('{{$bg_image_url}}');">
    <div class="container space-top-xl-3 py-6 py-xl-0">
        <div class="row justify-content-center py-xl-4">
            <div class="py-xl-10 py-5">
                <h1 class="font-size-40 font-size-xs-30 text-white font-weight-bold mb-0">{{ $title ?? "" }}</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter justify-content-center mb-0">
                        <li class="breadcrumb-item font-size-14"> <a class="text-white" href="{{ url("/") }}">{{ __("Home") }}</a> </li>
                        <li class="breadcrumb-item custom-breadcrumb-item font-size-14 text-white active" aria-current="page">
                            {{ $sub_title ?? "" }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>