<div class="bravo-unmissable-destinations">
    <div class="container mb-5 mt-5 mb-lg-8 pb-lg-1">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto">
            <h2 class="section-title text-black font-size-30 font-weight-bold mb-5">{{$title}}</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-5 col-xl-6">
                <div class="mb-5 mb-lg-0">
                    <img class="img-fluid w-100 rounded-top" src="{{get_file_url($bg_image,'full')}}" alt="{{$location_name}}">
                    <div class="bg-pink p-4 p-md-5 px-xl-8 pt-xl-5 pb-xl-7 rounded-bottom">
                        <h6 class="font-size-xs-30 font-size-50 font-weight-bold text-dark-2 mb-1">{{$location_name}}</h6>
                        <p class="text-lh-lg text-dark-2 pr-xl-14 mb-4">{{$location_desc}}</p>
                        <a href="{{$location_link}}" class="btn btn-outline-dark-2 rounded height-51 width-223 transition-3d-hover d-flex align-items-center justify-content-center border-width-2 mb-1">{{$location_btn}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-7 col-xl-6">
                <div class="row bravo-list-service">
                    @foreach($rows as $row)
                        <div class="col-md-6">
                            <div class="mb-3 mb-lg-2">
                                <div class="h-100 service-{{$row->type}}">
                                    @include(ucfirst($row->type)."::frontend.layouts.search.loop-grid",['wrap_class' => 'style_2'])
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
