<div class="portlet-title">
    <div class="caption font-red-sunglo">
        <i class="fa fa-tag font-red-sunglo" aria-hidden="true"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Estrangement Process')</span>
    </div>

    <div class="actions">
        <button class="btn btn-circle btn-icon-only btn-default" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-3-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
        <thead>
        <tr class="bg-red-thunderbird bg-font-red-thunderbird   ">
            <th>@lang('Number')</th>
            <th>@lang('Admission Date')</th>
            <th>@lang('Admission Reason')</th>
            <th>@lang('Plate')</th>
            <th>@lang('State')</th>
            <th>@lang('Estrangement state')</th>
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
                <td class="p-t-5">
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
                        <i class="fa fa-database" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script type="application/javascript">
    Inventory.initPhaseTable($('#inventory-phase-3-table'));
</script>