@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('Inventories')</div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Number')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Admission Reason')</th>
                                    <th>@lang('Plate')</th>
                                    <th>@lang('State')</th>
                                    <th>@lang('Limitation')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventories as $inventory)
                                    <tr>
                                        <th>{{ $loop->index + 1 }}</th>
                                        <th>{{ $inventory->number }}</th>
                                        <th>{{ $inventory->date }}</th>
                                        <th>{{ $inventory->admissionReason->reason}}</th>
                                        <th>{{ $inventory->car->plate }}</th>
                                        <th>{{ $inventory->car->state->state}}</th>
                                        <th>{{ $inventory->car->limitation->limitation}}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
