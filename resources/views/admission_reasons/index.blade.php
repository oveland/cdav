@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admission Reasons</div>

                    <div class="panel-body">
                        You are logged in Admission Reason! <a href="{{ route('admission-reasons.show',1)  }}">See detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
