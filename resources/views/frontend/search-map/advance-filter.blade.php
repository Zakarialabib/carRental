@php
    $car_map_search_fields = setting_item_array('car_map_search_fields');
    $usedAttrs = [];
    foreach ($car_map_search_fields as $field){
        if($field['field'] == 'attr' and !empty($field['attr']))
        {
            $usedAttrs[] = $field['attr'];
        }
    }
    $selected = (array) request()->query('terms');
@endphp
<div id="advance_filters" class="d-none">
    <div class="ad-filter-b">
        @foreach ($attributes as $item)
            @if(empty($item['hide_in_filter_search']))
                @php
                if(in_array($item->id,$usedAttrs)) continue;
                    $translate = $item->translate();
                @endphp
                <div class="filter-item">
                    <div class="filter-title"><strong>{{$translate->name}}</strong></div>
                    <ul class="filter-items row">
                        @foreach($item->terms as $term)
                            @php $translate = $term->translate(); @endphp
                            <li class="filter-term-item col-xs-6 col-md-4">
                                <label><input @if(in_array($term->id,$selected)) checked @endif type="checkbox" name="terms[]" value="{{$term->id}}"> {{$translate->name}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
    <div class="ad-filter-f text-right">
        <a href="#" onclick="return false" class="btn btn-primary bn-sm btn-apply-advances">{{__("Apply Filters")}}</a>
    </div>
</div>
