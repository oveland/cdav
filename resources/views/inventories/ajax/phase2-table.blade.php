<div class="portlet-title">
    <div class="caption font-green-sharp">
        <i class="icon-ghost font-green-sharp" aria-hidden="true"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Abandonment Declaration')</span>
    </div>

    <div class="actions">
        <button class="btn btn-circle btn-icon-only btn-success tooltips" data-original-title="@lang('Download report')">
            <i class="fa fa-download"></i>
        </button>
        <button class="btn btn-circle btn-icon-only btn-default"
                data-container="body" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-2-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
    <thead>
        <tr class="bg-green-seagreen bg-font-green-seagreen">
            <th>@lang('Number')</th>
            <th>@lang('Admission Date')</th>
            <th>@lang('Admission Reason')</th>
            <th>@lang('Plate')</th>
            <th>@lang('Type')</th>
            <th class="hide">@lang('State')</th>
            <th>@lang('Abandonment state')</th>
            <th>@lang('Actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryProcesses->sortByDesc('id') as $inventoryProcess)
            @php
                $inventory = $inventoryProcess->inventory;
            @endphp
            <tr class="odd gradeX">
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->date }}</td>
                <td>{{ $inventory->admissionReason->name }}</td>
                <td class="uppercase">{{ $inventory->car->plate }}</td>
                <td>{{ $inventory->car->type->name }}</td>
                <td class="p-t-5 hide">
                    <span style="width: 100px" class="label {{ $inventory->car->state->color_class }}"> {{ $inventory->car->state->name}}</span>
                </td>
                <td class="{{ $inventoryProcess->started?'text-warning':'' }}">
                    {{ $inventoryProcess->started?__('Yes'):__('No') }}
                </td>
                <td class="text-center">
                    @if(!$inventoryProcess->started)
                    <button data-action="{{ route('inventory-ajax','startAbandonmentDeclaration') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-process-start tooltips btn btn-circle yellow-crusta btn-outline sbold uppercase btn-xs"
                            data-modal="#ajax-modal-car-detail"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Start abandonment declaration process')">
                        <i class="icon-ghost" aria-hidden="true"></i>
                    </button>
                    @endif
                    <button data-action="{{ route('inventory-ajax','loadCarProcessView') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-car-process tooltips btn btn-circle green-haze btn-outline sbold uppercase btn-xs"
                            data-modal="#ajax-modal-car-detail"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('See/Update state')">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script type="application/javascript">
    Inventory.initPhaseTable($('#inventory-phase-2-table'));
</script>