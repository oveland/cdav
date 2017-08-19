<div class="portlet-title">
    <div class="caption text-success">
        <i class=" icon-layers"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Inventory Register')</span>
    </div>

    <div class="actions">
        <button class="ajax-btn-car-process btn btn-circle btn-icon-only green popovers" data-action="{{ route('ajax-inventory','newInventory') }}"
            data-container="body" data-trigger="hover" data-placement="bottom" data-content="@lang('Register New')" data-original-title="">
            <i class="icon-plus"></i>
        </button>

        <button class="ajax-btn-test btn btn-circle btn-icon-only red popovers hide" data-action="{{ route('store-inventory') }}">
            <i class="fa fa-clock-o"></i>
        </button>

        <button class="btn btn-circle btn-icon-only btn-default" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-1-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
        <thead>
        <tr class="bg-green-meadow bg-font-green-meadow">
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
                    <button data-action="{{ route('ajax-inventory','loadCarProcessView') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-car-process popovers btn btn-circle green-haze btn-outline sbold uppercase"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-content="@lang('See/Update state')" data-original-title="@lang('Actions')">
                        <i class="fa fa-database" aria-hidden="true"></i>
                    </button>
                    <button data-action="{{ route('ajax-inventory','processToPhase2') }}?id={{ $inventoryProcess->id }}" class="ajax-btn-process-next-phase process popovers btn btn-circle red-haze btn-outline sbold uppercase"
                            data-container="body" data-trigger="hover" data-placement="bottom" data-content="@lang('Process to phase') 2" data-original-title="@lang('Process')">
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<script type="application/javascript">
    Inventory.initPhaseTable($('#inventory-phase-1-table'));

    $('.ajax-btn-test').click(function(){
        $.ajax({
            url: $(this).data('action'),
            type:'post',
            data:{
                number: 98987,
                admission_reason_id: 1,
                plate: "AAA-000",
                engine_number: "212iu31k",
                chassis_number: "12231298U",
                model: "2000",
                color: "Rojo",
                registration_city: "Cali",
                cars_state_id: 1,
                identity: "90887",
                name: "Oscar Velásquez",
                address: "Popayán, Cauca",
                email: "oiva.fz@gmail.com",
                phone: "3145224212"
            },
            success:function (data) {
                console.log(data);
            },
            error:function () {
                alert('Error ajax call');
            },
            complete:function () {
                console.log('Complete');
            }
        });
    });

</script>