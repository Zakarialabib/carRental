<?php
use App\Blocks;

use Modules\Flight\Models\SeatType;
use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class ListServicesByLocation extends BaseBlock
{

    function __construct()
    {
        $list_service = $list_location = [];
        $locations = Location::where("status","publish")->limit(1000)->orderBy('name', 'asc')->with(['translations'])->get()->toTree();
        foreach (get_bookable_services() as $key => $service) {
            $list_service[] = ['value'   => $key, 'name' => ucwords($key)];
        }

        $arg[] = [
            'id'        => 'title',
            'type'      => 'input',
            'inputType' => 'text',
            'label'     => __('Title')
        ];

        $arg[] = [
            'id'            => 'service_types',
            'type'          => 'radios',
            'label'         => "<strong>".__('Service Type')."</strong>",
            'values'        => $list_service,
        ];

        if (!empty($locations)){
            foreach ($locations as $location){
                $list_location[] = ['value' => $location->id, 'name' => $location->name];
            }
            $arg[] = [
                'id'            => 'location_id',
                'type'          => 'checklist',
                'listBox'          => 'true',
                'label'         => "<strong>".__('Locations')."</strong>",
                'values'        => $list_location,
            ];
        }

        $arg[] =  [
            'id'            => 'style',
            'type'          => 'radios',
            'label'         => __('Style'),
            'values'        => [
                [
                    'value'   => '',
                    'name' => __("Style 1")
                ],
            ]
        ];

        $this->setOptions([
            'settings' => $arg,
            'category'=>__("Other Block")
        ]);
    }

    public function getName()
    {
        return __('List Services By Location');
    }

    public function content($model = [])
    {
        $allServices = get_bookable_services();
        $module = new $allServices[$model['service_types']];
        $model['list_location'] = Location::whereIn('id',$model['location_id'])->get();
        $model['rows'] = $module::where('status','publish')->whereIn('location_id',$model['location_id'])->limit(1000)->orderBy('id', 'DESC')->with(['translations'])->get();
        $model['style'] = !empty($model['style']) ? $model['style'] :  "style_1";
        $model['modelBlock'] = $model;

        return view('Template::frontend.blocks.list-services-by-location.'.$model['style'], $model);
    }
}
