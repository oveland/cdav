<div class="portlet-title">
    <div class="caption font-red-sunglo">
        <i class="fa fa-tag font-red-sunglo" aria-hidden="true"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Estrangement Process')</span>
    </div>

    <div class="actions">
        <button class="btn btn-circle btn-icon-only btn-default tooltips" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));" data-original-title="@lang('Update')">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-3-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
        <thead>
        <tr class="bg-red-thunderbird bg-font-red-thunderbird   ">
            <th class="text-center"><i class="icon-tag"></i></th>
            <th>@lang('Number')</th>
            <th>@lang('Admission Date')</th>
            <th>@lang('Plate')</th>
            <th>@lang('Type')</th>
            <th>@lang('State')</th>
            <th>@lang('Estrangement state')</th>
            <th>@lang('Actions')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inventoryProcesses->sortByDesc('id') as $inventoryProcess)
            @php
                $inventory = $inventoryProcess->inventory;
                $car = $inventory->car;
            @endphp
            <tr class="odd gradeX">
                <td class="text-center">
                    @switch($inventoryProcess->notification_phase)
                        @case(1)
                            <i class="icon-envelope font-yellow faa-flash animated tooltips"
                            data-original-title="@lang('Waiting response to personal notification')">
                            </i>
                            @break

                        @case(2)
                            <i class="fa fa-bullhorn font-orange faa-flash animated tooltips"
                            data-original-title="@lang('Waiting response to notice notification')">
                            </i>
                            @break

                        @case(3)
                            <i class="icon-tag font-red-flamingo faa-flash animated tooltips"
                               data-original-title="@lang('In estrangement state')">
                            </i>
                            @break

                        @default
                            @break
                    @endswitch
                </td>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->date }}</td>
                <td class="uppercase">{{ $car->plate }}</td>
                <td>{{ $car->type->name }}</td>
                <td class="p-t-5">
                    <span class="label {{ $car->state->color_class }}"> {{ $car->state->name}}</span>
                </td>
                <td class="{{ $inventoryProcess->started?'text-warning':'' }}">
                    {{ $inventoryProcess->started?__('Yes'):__('No') }}
                </td>
                <td class="text-center">
                    @if($inventoryProcess->started)
                        @switch($inventoryProcess->notification_phase)
                            @case(0)
                                <button data-action="{{ route('inventory-ajax','startNextEstrangementProcess') }}?id={{ $inventoryProcess->id }}"
                                        class="ajax-btn-process-start tooltips btn btn-circle yellow btn-outline sbold uppercase btn-xs faa-horizontal animated-hover"
                                        data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Send personal notification')">
                                    <i class="icon-envelope" aria-hidden="true"></i>
                                </button>
                                @break
                            @case(1)
                                <button data-action="{{ route('inventory-ajax','startNextEstrangementProcess') }}?id={{ $inventoryProcess->id }}"
                                        class="ajax-btn-process-start tooltips btn btn-circle orange btn-outline sbold uppercase btn-xs"
                                        data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Generate notification by notice')">
                                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                </button>
                                @break
                            @case(2)
                                <button data-action="{{ route('inventory-ajax','startNextEstrangementProcess') }}?id={{ $inventoryProcess->id }}"
                                        class="ajax-btn-process-start tooltips btn btn-circle orange btn-outline sbold uppercase btn-xs"
                                        data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Generate notification by notice')">
                                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                </button>
                                @break
                        @endswitch
                    @else
                        <button data-action="{{ route('inventory-ajax','startInventoryPhaseProcess') }}?id={{ $inventoryProcess->id }}"
                                class="ajax-btn-process-start tooltips btn btn-circle red-flamingo btn-outline sbold uppercase btn-xs faa-flash animated-hover"
                                data-modal="#ajax-modal-car-detail"
                                data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Start estrangement process')">
                            <i class="icon-tag" aria-hidden="true"></i>
                        </button>
                    @endif
                    <button data-action="{{ route('inventory-ajax','loadCarProcessView') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-car-process tooltips btn btn-circle green-haze btn-outline sbold uppercase btn-xs"
                            data-modal="#ajax-modal-car-detail"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Details')">
                        <i class="fa fa-eye" aria-hidden="true"></i>
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