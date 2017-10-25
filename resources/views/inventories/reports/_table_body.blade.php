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
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <span class="property">@lang('Identity'):</span> ({{ $proprietary->identity_type }}) {{ $proprietary->identity }}
                </div>
                <div class="col-md-12">
                    <span class="property">@lang('Name'):</span> {{ $proprietary->name }}
                </div>
                <div class="col-md-12">
                    <span class="property">@lang('Address'):</span> {{ $proprietary->address }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <span class="property">@lang('Phone'):</span> {{ $proprietary->phone }}
                </div>
                <div class="col-md-12">
                    <span class="property">@lang('Email'):</span> {{ $proprietary->email }}
                </div>
            </div>
        </div>
    </td>
</tr>