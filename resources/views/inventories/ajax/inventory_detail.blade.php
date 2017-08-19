@php
    $inventory = $inventoryProcess->inventory;
    $car = $inventoryProcess->inventory->car;
    $proprietary = $car->proprietary;
    $phaseColor = ['info','success','warning','danger'];
@endphp
<div class="portlet light m-b-0">
    <div class="portlet-title">
        <div class="caption">
            <i class=" icon-layers font-red"></i>
            <span class="caption-subject font-red bold uppercase">@lang('Inventory detail')</span>
        </div>
        <div class="actions">
            <a data-action="{{ route('ajax-inventory','loadCarProcessView') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-car-process btn btn-circle btn-icon-only btn-default">
                <i class="fa fa-refresh"></i>
            </a>
            <a class="btn btn-circle red-mint btn-outline sbold btn-icon-only" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body row">
        <div class="col-md-12">
            <div class="mt-element-ribbon bg-grey-steel p-b-0 m-b-0">
                <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-danger">
                    <div class="ribbon-sub ribbon-clip"></div>
                    @lang('Inventory'): <strong>{!! $inventory->number or 'None' !!}</strong>
                </div>
                <div class="ribbon ribbon-vertical-right ribbon-border-dash-vert ribbon-shadow ribbon-color-default uppercase font-grey-cararra" style="margin-right: 50px">
                    <i class="fa fa-calendar m-r-10"></i><strong class="pull-right">{{ $inventory->date }}</strong>
                </div>
                <div class="ribbon ribbon-right ribbon-vertical-right ribbon-shadow ribbon-border-dash-vert ribbon-color-{{ $phaseColor[$inventoryProcess->phase] }} uppercase">
                    <div class="ribbon-sub ribbon-bookmark"></div>
                    <strong class="p-4">{{ $inventoryProcess->phase  }}</strong>
                </div>

                <div class="row m-t-40">
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet box green-seagreen">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-car f-s-24"></i>@lang('Vehicle')
                                </div>
                                <div class="actions">
                                    <a href="javascript:;" class="btn btn-default btn-sm btn-circle" onclick="toastr['info']('Funcionalidad en proceso de desarrollo', 'Información')">
                                        <i class="fa fa-spin fa-cog"></i> Edit
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Plate'): </div>
                                    <div class="col-md-5 value">{{ $car->plate }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Engine Number'): </div>
                                    <div class="col-md-5 value">{{ $car->engine_number }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Chassis Number'): </div>
                                    <div class="col-md-5 value">{{ $car->chassis_number }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Model'): </div>
                                    <div class="col-md-5 value">{{ $car->model }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Color'): </div>
                                    <div class="col-md-5 value">{{ $car->color }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Registration City'): </div>
                                    <div class="col-md-5 value">{{ $car->registration_city }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Judicial Pending'): </div>
                                    <div class="col-md-5 value">{{ $car->pending_judicial }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('State'): </div>
                                    <div class="col-md-5 value">
                                        <span style="width: 100px" class="label {{ $car->state->color_class }}"> {{ $car->state->state}}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Created at'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->created_at }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Updated at'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->updated_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet box blue-ebonyclay">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-user f-s-24"></i>@lang('Proprietary')
                                </div>
                                <div class="actions">
                                    <a href="javascript:;" class="btn btn-default btn-sm btn-circle" onclick="toastr['info']('Funcionalidad en proceso de desarrollo', 'Información')">
                                        <i class="fa fa-spin fa-cog"></i> Edit
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Identity'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->identity }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Name'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->name }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Address'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->address }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Phone'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->phone }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Email'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->email }}</div>
                                </div>
                                <hr>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Created at'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->created_at }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Updated at'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->updated_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-circle yellow-mint btn-outline sbold uppercase" type="button" data-dismiss="modal">@lang('Close')</button>
</div>