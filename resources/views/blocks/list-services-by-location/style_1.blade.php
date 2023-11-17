<div class="list-service-by-location">
    <div class="container space-top-1 pb-3 mb-1">
        @if(!empty($title))
            <div class="w-md-80 w-lg-50 text-center mx-md-auto my-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title}}</h2>
            </div>
        @endif
        @if(!empty($list_location))
            <ul class="nav tab-nav-line flex-nowrap pb-4 tab-nav justify-content-lg-center text-nowrap" role="tablist">
                @foreach($list_location as $k => $list)
                    <li class="nav-item">
                        <a class="nav-link font-weight-medium @if($k==0) active @endif" id="location-{{$list->id}}-tab" data-toggle="pill" href="#location-{{$list->id}}" role="tab" aria-controls="location-{{$list->id}}" aria-selected="true">
                            <div class="d-flex flex-column flex-md-row  position-relative text-dark align-items-center">
                                <span class="tabtext font-weight-semi-bold">{{$list->name}}</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($list_location as $k => $list)
                    <div class="tab-pane fade @if($k==0) active show @endif" id="location-{{$list->id}}" role="tabpanel" aria-labelledby="location-{{$list->id}}-tab">
                        <div class="row">
                            @foreach($rows as $row)
                                @if($list->id == $row->location_id)
                                    <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
                                        @include(ucfirst($row->type)."::frontend.layouts.search.loop-grid")
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
