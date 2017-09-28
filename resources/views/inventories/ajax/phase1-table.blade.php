<div class="portlet-title">
    <div class="caption font-green-jungle">
        <i class="icon-layers font-green-jungle"></i>
        <span class="caption-subject bold uppercase">@lang('List') - @lang('Inventory Register')</span>
    </div>

    <div class="actions">
        <button class="ajax-btn-car-process btn btn-circle btn-icon-only green popovers"
                data-modal="#ajax-modal-car-process"
                data-action="{{ route('inventory-ajax','newInventory') }}"
                data-container="body" data-trigger="hover" data-placement="bottom" data-content="@lang('Register New')" data-original-title="">
            <i class="icon-plus"></i>
        </button>

        <button class="ajax-btn-test btn btn-circle btn-icon-only red hide" data-action="{{ route('inventory-store') }}">
            <i class="fa fa-check"></i>
        </button>

        <button class="btn btn-circle btn-icon-only btn-default" onclick="Inventory.loadPhaseContainer($(this).parents('.phase-container'));">
            <i class="icon-refresh"></i>
        </button>
    </div>
</div>
<div class="portlet-body">
    <table id="inventory-phase-1-table" class="table table-striped table-bordered table-hover order-column table-lightsss">
        <thead>
        <tr class="bg-green-jungle bg-font-green-jungle">
            <th>@lang('Number')</th>
            <th>@lang('Admission Date')</th>
            <th>@lang('Admission Reason')</th>
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
            @endphp
            <tr class="odd gradeX">
                <td>{{ $inventory->id }}</td>
                <td>{{ $inventory->date }}</td>
                <td>
                    <span class="{{ $inventory->car->hasPendingJudicial()?'text-danger tooltips':'' }}" data-original-title="@lang('Whit pending judicial')">
                        {{ $inventory->admissionReason->name}}
                    </span>
                </td>
                <td class="uppercase">{{ $inventory->car->plate }}</td>
                <td>{{ $inventory->car->type->name}}</td>
                <td class="p-t-5">
                    <span style="width: 100px" class="label {{ $inventory->car->state->color_class }}"> {{ $inventory->car->state->name}}</span>
                </td>
                <td class="text-center">
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
    Inventory.initPhaseTable($('#inventory-phase-1-table'));

    $('.ajax-btn-test').click(function(){
        $.ajax({
            url: $(this).data('action'),
            type:'post',
            data:{
                admission_reason_id: 1,
                plate: "AAA-000",
                engine_number: "212iu31k",
                chassis_number: "12231298U",
                model: "2000",
                color: "Rojo",
                registration_city: "Cali",
                cars_type_id: 1,
                cars_state_id: 1,
                identity_type: "CC",
                identity: "9088700090",
                name: "Oscar Velásquez",
                address: "Popayán, Cauca",
                email: "oiva.fz@gmail.com",
                phone: "3145224212"
            },
            success:function (data) {
                toastr['success']("Exito!", '@lang('Success')');
            },
            error:function (event,xhr,options,exc) {
                var message = "Ocurrió un error al crear el registro. Contacte a su administrador";
                try {
                    var errors = event.responseJSON;
                    message = "Algunos campos no cumplen con lo requerido:<br>";
                    message += "<ul>";
                    for (var i in errors) {
                        message += '<li>' + errors[i].toString() + '</li>';
                    }
                    message += '</ul>';
                } catch (e) {
                    console.log('ERROR CONTACT WITH ADMIN');
                }
                toastr['error'](message, '@lang('Error')');
            },
            complete:function () {
                console.log('Complete');
            }
        });
    });

</script>