<div class="portlet-title">
    <div class="caption text-success">
        <i class=" icon-layers"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Abandonment Declaration')</span>
    </div>

    <div class="actions">
        <button class="btn btn-circle btn-icon-only btn-default" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-2-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
    <thead>
        <tr class="bg-green-seagreen bg-font-green-seagreen">
            <th>@lang('Number')</th>
            <th>@lang('Date')</th>
            <th>@lang('Admission Reason')</th>
            <th>@lang('Plate')</th>
            <th>@lang('State')</th>
            <th>@lang('Limitation')</th>
            <th>@lang('Actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryProcesses as $inventoryProcess)
            @php
                $inventory = $inventoryProcess->inventory;
            @endphp
            <tr class="odd gradeX">
                <td>{{ $inventory->number }}</td>
                <td>{{ $inventory->date }}</td>
                <td>{{ $inventory->admissionReason->reason}}</td>
                <td class="uppercase">{{ $inventory->car->plate }}</td>
                <td class="p-t-10">
                    <span style="width: 100px" class="label {{ $inventory->car->state->color_class }}"> {{ $inventory->car->state->state}}</span>
                </td>
                <td>{{ $inventory->car->limitation?$inventory->car->limitation->limitation:__('Nothing')}}</td>
                <td class="text-center">
                    <button data-action="{{ route('ajax-inventory','loadCarProcessView') }}?id={{ $inventory->id }}" class="ajax-btn-car-process popovers btn btn-circle green-haze btn-outline sbold uppercase"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-content="Ver detalle/actualizar estado" data-original-title="Acciones">
                        <i class="fa fa-database" aria-hidden="true"></i>
                    </button>
                    <button data-action="{{ route('ajax-inventory','processToPhase3') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-process-next-phase process popovers btn btn-circle red-haze btn-outline sbold uppercase"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-content="@lang('Process to phase') 3" data-original-title="@lang('Process')">
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
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