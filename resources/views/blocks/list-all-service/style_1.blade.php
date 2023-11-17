@php $key_time = time(); @endphp
<div class="bravo-list-all-service tabs-block tab-v1 ">
    <div class="container space-1">
        <div class="w-md-80 w-lg-50 text-center mx-md-auto my-3">
            <h2 class="section-title text-black font-size-30 font-weight-bold mb-0">{{$title ?? ''}}</h2>
        </div>
        <ul class="nav tab-nav-pill flex-nowrap pb-4 pb-lg-5 tab-nav justify-content-lg-center" role="tablist">
            @if(!empty($service_types))
                @php $number = 0; @endphp
                @foreach ($service_types as $service_type)
                    @php
                        $allServices = get_bookable_services();
                        if(empty($allServices[$service_type])) continue;
                        $module = new $allServices[$service_type];
                    @endphp
                    <li class="nav-item" role="bravo_{{$service_type}}">
                        <a class="nav-link font-weight-medium @if($number == 0) active @endif" data-toggle="pill" href="#bravo_{{$key_time.$service_type}}-tab">
                            <div class="d-flex flex-column flex-md-row  position-relative text-dark align-items-center">
                                <span class="tabtext font-weight-semi-bold">
                                    {{ !empty($modelBlock["title_for_".$service_type]) ? $modelBlock["title_for_".$service_type] : $module->getModelName() }}
                                </span>
                            </div>
                        </a>
                    </li>
                    @php $number++; @endphp
                @endforeach
            @endif
        </ul>
        <div class="tab-content">
            @if(!empty($service_types))
                @php $number = 0; @endphp
                @foreach ($service_types as $service_type)
                    @php
                        $allServices = get_bookable_services();
                        if(empty($allServices[$service_type]) and !empty($rows[$service_type])) continue;
                    @endphp

                    <div class="tab-pane fade @if($number == 0) active show @endif bravo_{{$service_type}}" id="bravo_{{$key_time.$service_type}}-tab">
                        <div class="row">
                            @foreach($rows[$service_type] as $row)
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-3 mb-md-4 pb-1">
                                    @include(ucfirst($service_type).'::frontend.layouts.search.loop-grid')
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @php $number++; @endphp
                @endforeach
            @endif

        </div>
    </div>
</div>