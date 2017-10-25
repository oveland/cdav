<div class="portlet-title">
    <div class="caption font-red-sunglo">
        <i class="fa fa-tag font-red-sunglo" aria-hidden="true"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Estrangement Process')</span>
    </div>

    <span class="caption m-l-40 phase-status-container">
        <span class="pull-left m-r-10 small">
            @lang('States'):
        </span>

        <button class="tooltips btn blue-madison sbold uppercase btn-xs"
            data-placement="bottom" data-original-title="@lang('Waiting response to personal notification')">
            <i class="icon-envelope-open faa-bounce" aria-hidden="true"></i>
        </button>

        <button class="tooltips btn yellow-lemon sbold uppercase btn-xs"
            data-placement="bottom" data-original-title="@lang('Waiting response to notification by notice')">
            <i class="fa fa-bullhorn faa-bounce" aria-hidden="true"></i>
        </button>

        <i class="icon-tag font-red-flamingo faa-flash tooltips m-l-10 pull-right"
           data-placement="bottom" data-original-title="@lang('In estrangement state')">
        </i>
    </span>

    <div class="actions">
        <div class="btn-group" data-original-title="@lang('Download report')" data-placement="left">
            <button class="btn btn-circle red dropdown-toggle btn-download" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-download"></i>
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('reports-personal-notification-phase-3') }}" class="tooltips" data-original-title="@lang('Report of') @lang('Personal notifications')">
                        <i class="icon-envelope-open faa-bounce font-blue-madison" aria-hidden="true"></i> | @lang('By Personal')
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports-notice-notification-phase-3') }}" class="tooltips" data-original-title="@lang('Report of') @lang('Notice notifications')">
                        <i class="fa fa-bullhorn faa-bounce font-yellow-lemon" aria-hidden="true"></i> | @lang('By Notice')
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports-phase-3') }}" class="tooltips" data-original-title="@lang('Report of') @lang('In Estrangement')">
                        <i class="icon-tag faa-flash font-red-flamingo"></i> | @lang('In Estrangement')
                    </a>
                </li>
            </ul>
        </div>

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
                        @if($inventoryProcess->withPersonalNotification())
                            <button data-action="{{ route('inventory-ajax','responseToNotificationPhaseProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn blue-madison sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Response to personal notification')">
                                <i class="icon-envelope-open
                                 faa-bounce" aria-hidden="true"></i>
                            </button>
                        @elseif($inventoryProcess->withNoticeNotification())
                            <button data-action="{{ route('inventory-ajax','responseToNotificationPhaseProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn yellow-lemon sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Response to notification by notice')">
                                <i class="fa fa-bullhorn faa-bounce" aria-hidden="true"></i>
                            </button>
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
                        @if($inventoryProcess->withOutNotification())
                            <button data-action="{{ route('inventory-ajax','loadViewDescriptionNotification') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-start-next-sub-phase tooltips btn btn-circle blue-madison btn-outline sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Send personal notification')">
                                <i class="icon-envelope faa-passing" aria-hidden="true"></i>
                            </button>
                        @elseif($inventoryProcess->withPersonalNotification())
                            <button data-action="{{ route('inventory-ajax','loadViewDescriptionNotification') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-start-next-sub-phase tooltips btn btn-circle yellow-lemon btn-outline sbold uppercase btn-xs faa-parent animated-hover"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Generate notification by notice')">
                                <i class="fa fa-bullhorn faa-wrench" aria-hidden="true"></i>
                            </button>
                        @elseif($inventoryProcess->withNoticeNotification())
                            <button data-action="{{ route('inventory-ajax','startInventoryPhaseProcess') }}?id={{ $inventoryProcess->id }}"
                                    class="ajax-btn-process-start tooltips btn btn-circle sle red-flamingo btn-outline sbold uppercase btn-xs faa-flash animated-hover"
                                    data-modal="#ajax-modal-car-detail"
                                    data-container="body" data-trigger="hover" data-placement="bottom" data-original-title="@lang('Start estrangement process')">
                                <i class="icon-tag" aria-hidden="true"></i>
                            </button>
                        @endif
                    @endif
                    <button data-action="{{ route('inventory-ajax','loadCarProcessDetail') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-car-process tooltips btn btn-circle green-haze btn-outline sbold uppercase btn-xs"
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