<?php
namespace Themes\BC\Location\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;

class ListLocations extends BaseBlock
{
    function getOptions()
    {
        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            if($key == "flight"){
                continue;
            }
            $list_service[] = ['value'   => $key,
                               'name' => ucwords($key)
            ];
        }
        return ([
            'settings' => [
                [
                    'id'            => 'service_type',
                    'type'          => 'checklist',
                    'listBox'          => 'true',
                    'label'         => "<strong>".__('Service Type')."</strong>",
                    'values'        => $list_service,
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'id'            => 'layout',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => 'style_1',
                            'name' => __("First row 2 cards")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 3 cards/ row")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("First row 3 cards")
                        ],
                        [
                            'value'   => 'style_4',
                            'name' => __("Slide 4 cards/slider")
                        ],
                        [
                            'value'   => 'style_5',
                            'name' => __("Style 5 cards/ row")
                        ],
                    ]
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'value'   => 'name',
                            'name' => __("Title")
                        ],
                    ],
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'radios',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'value'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'value'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ],
                ],
                [
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('List Location by IDs'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('location.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                    ],
                    'pre_selected' => route('location.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ]
            ],
            'category'=>__("Location Blocks")
        ]);
    }

    public function getName()
    {
        return __('List Locations');
    }

    public function content($model = [])
    {
        $list = $this->query($model);
        $data = [
            'rows'         => $list,
            'title'        => $model['title'],
            'desc'         => $model['desc'] ?? "",
            'service_type' => $model['service_type'],
            'layout'       => !empty($model['layout']) ? $model['layout'] : "style_1",
            'to_location_detail'=>$model['to_location_detail'] ?? ''
        ];
        if ($model['layout'] == 'style_5') $data['min_height'] = 'min-height-240';
        return $this->view("Location::frontend.blocks.list-locations.{$data['layout']}", $data);
    }

    public function contentAPI($model = []){
        $rows = $this->query($model);
        $model['data']= $rows->map(function($row){
            return $row->dataForApi();
        });
        return $model;
    }

    public function query($model){
        if(empty($model['order'])) $model['order'] = "id";
        if(empty($model['order_by'])) $model['order_by'] = "desc";
        if(empty($model['number'])) $model['number'] = 5;
        if (empty($model['service_type']))
            return collect([]);
        $model_location = Location::query()->with(['translation']);
        $model_location->where("status","publish");
        if(!empty( $model['custom_ids'] )){
            $model_location->whereIn("id",$model['custom_ids']);
        }
        $model_location->orderBy($model['order'], $model['order_by']);
        return $model_location->limit($model['number'])->get();
    }
}
