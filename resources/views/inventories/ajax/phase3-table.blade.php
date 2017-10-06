<div class="portlet-title">
    <div class="caption font-red-sunglo">
        <i class="fa fa-tag font-red-sunglo" aria-hidden="true"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Estrangement Process')</span>
    </div>

    <div class="actions">
        <a href="{{ route('reports-phase-3') }}" class="btn btn-circle btn-icon-only btn-danger tooltips" data-original-title="@lang('Download report')">
            <i class="fa fa-download"></i>
        </a>
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
                    @if($inventoryProcess->started)
                        <i class="icon-tag font-red-flamingo faa-flash animated tooltips"
                           data-original-title="@lang('In estrangement state')">
                        </i>
                    @else
                        @php($notificationPhase = $inventoryProcess->notification_phase)
                        @if($notificationPhase == 1)
                            <i class="icon-envelope font-blue tooltips faa-passing animated"
                            data-original-title="@lang('Waiting response to personal notification')">
                            </i>
                        @elseif($notificationPhase == 2)
                            <i class="fa fa-bullhorn font-yellow-lemon tooltips faa-wrench animated"
                            data-original-title="@lang('Waiting response to notification by notice')">
                            </i>
                        @endif
                    @endif
                </td>
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventoryProcess->date }}</td>
                <td class="uppercase">{{ $car->plate }}</td>
                <td>{{ $car->type->name }}</td>
                <td class="p-t-5">
                    <span class="label span-full {{ $car->state->color_class }}"> {{ $car->state->name}}</span>
                </td>
                <td class="text-center">
                    @if(!$inventoryProcess->started)
                        @php($notificationPhase = $inventoryProcess->notification_phase)
                        @if($notificationPhase == 0)
                            <button data-action="{{ route('inventory-ajax','loadViewSendMailNotification') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-start-next-sub-phase tooltips btn btn-circle blue btn-outline sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Send personal notification')">
                                <i class="icon-envelope faa-passing" aria-hidden="true"></i>
                            </button>
                        @elseif($notificationPhase == 1)
                            <button data-action="{{ route('inventory-ajax','responseToEstrangementProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn blue sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Response to personal notification')">
                                <i class="icon-envelope-open
                                 faa-bounce" aria-hidden="true"></i>
                            </button>
                            <button data-action="{{ route('inventory-ajax','loadViewSendMailNotification') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-start-next-sub-phase tooltips btn btn-circle yellow-lemon btn-outline sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Generate notification by notice')">
                                <i class="fa fa-bullhorn faa-wrench" aria-hidden="true"></i>
                            </button>
                        @elseif($notificationPhase == 2)
                            <button data-action="{{ route('inventory-ajax','responseToEstrangementProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn yellow-lemon sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Response to notification by notice')">
                                <i class="fa fa-bullhorn faa-bounce" aria-hidden="true"></i>
                            </button>
                            <button data-action="{{ route('inventory-ajax','startInventoryPhaseProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn btn-circle sle red-flamingo btn-outline sbold uppercase btn-xs faa-flash animated-hover"
                                    data-modal="#ajax-modal-car-detail"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Start estrangement process')">
                                <i class="icon-tag" aria-hidden="true"></i>
                            </button>
                        @endif
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