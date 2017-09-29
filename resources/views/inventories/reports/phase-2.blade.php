<style rel="stylesheet">
    body *{
        font-size: 80%;
    }
    body {
        font-family: Raleway, sans-serif;
        color: #636b6f
    }
    table {
        border-collapse: collapse !important;
        border:1px solid grey !important;
    }
    th, td{
        padding: 5px;
        text-align:left;
        width: auto;
    }

    .vehicle-info td{
        background: rgba(96,172,170,0.11);
        border-bottom:1px solid rgba(128, 128, 128, 0.19);
        border-top: 3px solid lightgrey;
    }

    .bg-green-seagreen, .bg-hover-green-seagreen:hover {
        background: #1BA39C!important;
    }
    .bg-font-green-seagreen {
        color: #FFF!important;
    }
    .label {
        text-transform: uppercase;
        padding: 2px 6px 4px;
    }

    .label, .label.label-sm {
        font-weight: 600;
    }
    .label {
        color: #fff;

    }
    .bg-hover-yellow-lemon:hover, .bg-yellow-lemon {
        background: #F7CA18!important;
    }
    .bg-hover-red-flamingo:hover, .bg-red-flamingo {
        background: #EF4836!important;
    }

    .container-body, .container-header{
        margin:auto;
        width: 90%;
    }
    .portlet-body{
        display: inline-block;
        padding: 5px;
        width: 50%;
    }
    .title-proprietary{
        margin-bottom: 5px;
        margin-top: 0 !important;
    }
    .title-proprietary hr{
        position: absolute;
    }
    .property{
        font-weight: bold;
    }
</style>

<div class="container-header">
    <h1>@lang('CDAV - Patios')</h1>
    <hr>
</div>

<div class="container-body">
    <div class="portlet-title">
        <div class="caption font-green-sharp">
            <i class="icon-ghost font-green-sharp" aria-hidden="true"></i>
            <h2 class="caption-subject bold uppercase">@lang('List vehicles in Abandonment Declaration')</h2>
        </div>
    </div>
    <div>
        <table width="100%" id="inventory-phase-2-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
            <thead>
            <tr class="bg-green-seagreen bg-font-green-seagreen">
                <th>@lang('Number')</th>
                <th width="20%">@lang('Plate')</th>
                <th>@lang('Model')</th>
                <th>@lang('Color')</th>
                <th>@lang('Type')</th>
                <th class="hide">@lang('State') @lang('vehicle')</th>
                <th>@lang('Admission Date')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inventoryProcesses->sortByDesc('id') as $inventoryProcess)
                @php
                    $inventory = $inventoryProcess->inventory;
                    $car = $inventory->car;
                    $proprietary = $car->proprietary;
                @endphp
                <tr class="vehicle-info">
                    <td width="10%">{{ $inventory->id }}</td>
                    <td width="20%">{{ $car->plate }}</td>
                    <td width="10%">{{ $car->model }}</td>
                    <td width="10%">{{ $car->color }}</td>
                    <td width="10%">{{ $car->type->name }}</td>
                    <td width="10%">
                        <span class="label {{ $car->state->color_class }}"> {{ $car->state->name}}</span>
                    </td>
                    <td width="20%">{{ $inventory->date }}</td>
                </tr>
                <tr>
                    <td style="padding-top: 0"><h4 class="title-proprietary" style="margin: 0">@lang('Proprietary'):</h4></td>
                    <td colspan="7">
                        <div class="container-body" style="margin: 0 !important;">
                            <div class="portlet-body" style="margin: 0 !important;">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> <span class="property">@lang('Identity'):</span> ({{ $proprietary->identity_type }}) {{ $proprietary->identity }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> <span class="property">@lang('Name'):</span> {{ $proprietary->name }}</div>
                                </div>
                            </div>
                            <div class="portlet-body" style="margin: 0 !important;">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> <span class="property">@lang('Phone'):</span> {{ $proprietary->phone }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> <span class="property">@lang('Email'):</span> {{ $proprietary->email }}</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
