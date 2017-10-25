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

    .bg-red{
        background: #a31319 !important;
    }
    .bg-font-white {
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
    h1.uppercase{
        text-transform: uppercase;
        font-size: 150% !important;
    }
</style>

<div class="container-header">
    <h1>@lang('CDAV Patios') | @lang('Notice Notification')</h1>
    <hr>
</div>

<div class="container-body">
    <div class="portlet-title">
        <div class="caption font-green-sharp">
            <i class="icon-ghost font-green-sharp" aria-hidden="true"></i>
            <h1 class="caption-subject bold uppercase">@lang('Estrangement Process')</h1>
            <br>
            <h2 class="caption-subject bold uppercase">@lang('List vehicles for Estrangement state')</h2>
        </div>
    </div>
    <div>
        <table width="100%" id="inventory-phase-3-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
            <thead>
            <tr class="bg-red bg-font-white">
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
                    @include('inventories.reports._table_body',compact('$inventoryProcess'))
                @endforeach
            </tbody>
        </table>
    </div>
</div>
