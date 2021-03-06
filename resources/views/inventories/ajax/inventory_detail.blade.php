@php
    $inventory = $inventoryProcess->inventory;
    $car = $inventoryProcess->inventory->car;
    $proprietary = $car->proprietary;
    $phaseColor = ['info','success','warning','danger'];
    $pendingJudicialStr = $car->pending_judicial?'SI':'NO';
@endphp
<div class="portlet light m-b-0">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class=" icon-layers font-red"></i>
            <span class="caption-subject font-red bold uppercase">@lang('Inventory detail')</span>
        </div>

        <div class="actions pull-right">
            <a data-action="{{ route('inventory-ajax','loadCarProcessDetail') }}?id={{ $inventoryProcess->id }}" class="hide ajax-btn-car-process btn btn-circle btn-icon-only btn-default">
                <i class="fa fa-refresh"></i>
            </a>
            <a class="btn btn-circle red-mint btn-outline sbold btn-icon-only" data-dismiss="modal" title="@lang('Close')">
                <i class="fa fa-times"></i>
            </a>
        </div>

        <ul class="nav nav-tabs pull-right">
            <li class="active">
                <a href="#tab-general" data-toggle="tab">
                    <i class="fa fa-file-text-o"></i> @lang('General Information')
                </a>
            </li>
            <li>
                <a href="#tab-files" data-toggle="tab" onclick="Inventory.refreshPanelFiles()">
                    <i class="fa fa-picture-o"></i> @lang('Inventory Files')
                </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body tab-content row md-shadow-none">
        <div id="tab-general" class="tab-pane fade active in">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="mt-element-ribbon bg-grey-steel p-b-0 m-b-0">
                <div class="ribbon ribbon-border-hor ribbon-clip ribbon-color-{{ $phaseColor[$inventoryProcess->phase] }}" style="">
                    <div class="ribbon-sub ribbon-clip"></div>
                    @lang('Inventory'): <strong>{!! $inventory->id or 'None' !!}</strong>
                    <a href="javascript:return false;" style="z-index: 10000" class="btn btn-sm btn-circle yellow-mint font-white btn-outline m-l-20" onclick="toastr['info']('@lang('Feature on development')', '@lang('Information')')">
                        <i class="fa fa-spin fa-cog"></i> @lang('Edit')
                    </a>
                </div>
                <div class="ribbon ribbon-right ribbon-vertical-right ribbon-shadow ribbon-border-dash-vert ribbon-color-{{ $phaseColor[$inventoryProcess->phase] }} uppercase">
                    <div class="ribbon-sub ribbon-bookmark"></div>
                    <strong class="p-4">{{ $inventoryProcess->phase  }}</strong>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 m-t-25 p-0">
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <blockquote class="alert alert-{{ $phaseColor[$inventoryProcess->phase] }}">
                                <div class="row static-info">
                                    <div class="col-md-6 name">
                                        <i class="fa fa-pencil-square-o m-r-10"></i> @lang('Admission Reason'):
                                    </div>
                                    <div class="col-md-6 value">{{ $inventory->admissionReason->name }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-6 name">
                                        <i class="fa fa-ticket m-r-10"></i> @lang('Judicial Pending'):
                                    </div>
                                    <div class="col-md-6 value">
                                        {{ $pendingJudicialStr }}
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-6 name">
                                        <i class="fa fa-calendar m-r-10"></i> @lang('Admission Date'):
                                    </div>
                                    <div class="col-md-6 value">{{ $inventoryProcess->date }}</div>
                                </div>
                            </blockquote>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <blockquote class="bg-blue-hoki bg-font-blue-hoki">
                                <div class="row static-info p-20">
                                    @if( $inventoryProcess->started )
                                        @if( $inventoryProcess->isInAbandonedState() )
                                            <i class="fa-2x icon-ghost font-yellow-crusta faa-flash m-t-10 animated pull-left"></i>
                                            <p class="font-white f-s-12 m-l-20">@lang('In abandonment state')</p>
                                        @elseif( $inventoryProcess->isInEstrangementState() )
                                            <i class="fa-2x icon-tag font-red-flamingo faa-flash m-t-10 animated pull-left"></i>
                                            <p class="font-white f-s-12 m-l-20">@lang('In estrangement state')</p>
                                        @else
                                            <i class="fa-2x icon-layers font-green-jungle faa-flash m-t-10 animated pull-left"></i>
                                            <p class="font-white f-s-12 m-l-20">@lang('In initial inventory register')</p>
                                        @endif
                                    @else
                                        <div class="tooltips" data-original-title="{{ $inventoryProcess->observations }}">
                                            @if($inventoryProcess->withPersonalNotification())
                                                <i class="fa-2x icon-envelope font-blue faa-passing animated m-t-10 pull-left"></i>
                                                <p class="font-white f-s-12 m-l-20">@lang('Waiting response to personal notification')</p>
                                            @elseif($inventoryProcess->withNoticeNotification())
                                                <i class="fa-2x fa fa-bullhorn font-yellow-lemon faa-wrench animated m-t-10 pull-left"></i>
                                                <p class="font-white f-s-12 m-l-20">@lang('Waiting response to notification by notice')</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </blockquote>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="portlet box bg-dark">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-car f-s-24"></i>@lang('Vehicle') - {{ $car->type->name }}
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body" style="min-height: 200px;">
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Plate'): </div>
                                    <div class="col-md-5 value">{{ $car->plate }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Engine Number'): </div>
                                    <div class="col-md-5 value">{{ $car->engine_number }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Chassis Number'): </div>
                                    <div class="col-md-5 value">{{ $car->chassis_number }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Model'): </div>
                                    <div class="col-md-5 value">{{ $car->model }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Color'): </div>
                                    <div class="col-md-5 value">{{ $car->color }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Registration City'): </div>
                                    <div class="col-md-5 value">{{ $car->registration_city }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('Judicial Pending'): </div>
                                    <div class="col-md-5 value">{{ $pendingJudicialStr }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-7 name"> @lang('State'): </div>
                                    <div class="col-md-5 value">
                                        <span style="width: 100px" class="label {{ $car->state->color_class }}"> {{ $car->state->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-10 text-muted">
                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <i class="fa fa-calendar"></i>
                                        @lang('Created at'):
                                    </div>
                                    <div class="col-md-7 value">{{ $car->created_at }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <i class="fa fa-calendar"></i>
                                        @lang('Updated at'):
                                    </div>
                                    <div class="col-md-7 value">{{ $car->updated_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet box bg-dark">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-user f-s-24"></i> @lang('Proprietary')
                                </div>
                                <div class="actions">
                                </div>
                            </div>
                            <div class="portlet-body" style="min-height: 200px;">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Identity') <strong>({{ $proprietary->identity_type }})</strong>: </div>
                                    <div class="col-md-7 value">{{ $proprietary->identity }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Name'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->name }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Address'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->address }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Phone'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->phone }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> @lang('Email'): </div>
                                    <div class="col-md-7 value">{{ $proprietary->email }}</div>
                                </div>
                            </div>
                            <div class="p-10 text-muted">
                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <i class="fa fa-calendar"></i>
                                        @lang('Created at'):
                                    </div>
                                    <div class="col-md-7 value">{{ $proprietary->created_at }}</div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">
                                        <i class="fa fa-calendar"></i>
                                        @lang('Updated at'):
                                    </div>
                                    <div class="col-md-7 value">{{ $proprietary->updated_at }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div id="tab-files" class="tab-pane fade in p-20">
            <div class="col-md-12 m-b-20 p-0">
                <form action="{{ route('inventory-files',['inventory'=>$inventory->id]) }}" class="dropzone dropzone-file-area m-0" id="{{ $inventory->id }}">
                    <div class="">
                        {{ csrf_field() }}
                        <h3 class="sbold">@lang('Images and related files')</h3>
                    </div>
                </form>
            </div>
            <div class="portlet light bordered file-container col-md-12" data-url="{{ route('inventory-files-refresh',['inventory'=> $inventory->id ]) }}"></div>
        </div>
    </div>
</div>
<div class="modal-footer col-md-12 m-t-10">
    <button class="btn btn-circle yellow-mint btn-outline sbold uppercase" type="button" data-dismiss="modal">@lang('Close')</button>
    @if($inventoryProcess->phase < \App\InventoryProcess::ESTRANGEMENT_PHASE && $inventoryProcess->started)
        @php
            $nextPhase = $inventoryProcess->phase + 1;
            $canNextPhase = $inventoryProcess->canPassToPhase2();
        @endphp
        <button class="{{ $canNextPhase?'ajax-btn-process-next-phase':'' }} process popovers btn btn-circle sbold text-capitalize btn-{{ $phaseColor[$nextPhase] }} btn-outline {{ $canNextPhase?'':'disabled' }}"
                @if($canNextPhase)
                    data-action="{{ route('inventory-ajax','processToPhase'.$nextPhase) }}?id={{ $inventoryProcess->id }}"
                    data-phase-container="#phase-{{ $inventoryProcess->phase }}"
                @else
                    onclick="toastr['warning']('@lang('Vehicle not ready for next phase')', '@lang('Information')')"
                @endif
                data-container="body" data-trigger="hover" data-placement="bottom"
                data-content="@lang('Process to phase') {{ $nextPhase }}" data-original-title="@lang('Process')">
            @lang('Process to phase') {{ $nextPhase }} <i class="fa fa-angle-double-right"></i>
        </button>
    @endif
</div>

<script type="application/javascript">
    $(document).ready(function () {
        $("#{{ $inventory->id }}").dropzone({
            url: $(this).attr('action'),
            dictDefaultMessage: "<i class='fa f-s-24 font-red fa-upload'></i> @lang("Drop files here to upload")",
            dictFileTooBig: "@lang('File is too big') (\{\{filesize\}\}MiB). @lang('Max filesize'): \{\{maxFilesize\}\}MiB.",
            dictResponseError: "@lang('Ups some went wrong') \{\{statusCode\}\}",
            dictMaxFilesExceeded: "@lang('You can not upload any more files.')",
            maxFilesize: 100, // MB
            maxFiles: 20,
            //previewTemplate: document.querySelector('#template-container-dropzone').innerHTML,
            renameFile: function(file){
                console.log('RENAME FILE:');
                console.log(file);
            },
            init: function () {
                this.on("complete", function (file) {
                    var dropzone = this;
                    Inventory.refreshPanelFiles();
                    setTimeout(function(){
                        dropzone.removeFile(file);
                    },1500);
                });

                this.on("success", function (file) {
                    // Create the remove button
                    var removeButton = Dropzone.createElement("<a href='javascript:;'' class='hide btn red m-t-10 btn-sm btn-block'><i class='fa fa-trash'></i> @lang('Remove')</a>");

                    // Capture the Dropzone instance as closure.
                    var _this = this;

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });
            }
        });
    });
</script>