<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-plus-circle font-red"></i>
            <span class="caption-subject font-red bold uppercase">@lang('Create New')</span>
        </div>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:void(0);" data-dismiss="modal">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body form">
        <form action="{{ route('inventory-store') }}" class="form-horizontal" id="form-create" method="post">
            {{ csrf_field() }}
            <div class="fuelux">
                <div class="wizard" data-initialize="wizard" id="wizard-create">
                    <div class="steps-container">
                        <ul class="steps">
                            <li data-step="1" data-name="campaign" class="active">
                                <i class="icon-layers"></i> @lang('Inventory')
                                <span class="chevron"></span>
                            </li>
                            <li data-step="2">
                                <i class="fa fa-car"></i> @lang('Vehicle')
                                <span class="chevron"></span>
                            </li>
                            <li data-step="3">
                                <i class="fa fa-user"></i> @lang('Proprietary')
                                <span class="chevron"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="step-content">
                        <div id="tab-inventory" class="step-pane row active" data-step="1">
                            <div class="form-group">
                                <label for="admission_reason_id" class="col-md-4 control-label">@lang('Admission Reason')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="fa fa-pencil-square-o"></i>
                                        <select id="admission_reason_id" class="form-control input-circle select2" name="admission_reason_id">
                                            @foreach(\App\AdmissionReason::parents()->get() as $parentAdmissionReason)
                                                <optgroup label="{{ $parentAdmissionReason->description }}">
                                                    @foreach($parentAdmissionReason->admissionReasons as $admissionReason)
                                                        <option value="{{ $admissionReason->id }}">{{ $admissionReason->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-md-checkboxes">
                                <label for="pending_judicial" class="col-md-4 control-label">@lang('Judicial Pending')</label>
                                <div class="col-md-4 md-checkbox-list">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="pending_judicial" class="md-check" onchange="$('.pending_judicial').val( $(this).prop('checked') )">
                                        <input type="hidden" class="pending_judicial" name="pending_judicial" value="false">
                                        <label for="pending_judicial">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-vehicle" class="step-pane row" data-step="2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plate" class="col-md-4 control-label">@lang('Plate')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-car"></i>
                                            <input id="plate" name="plate" class="form-control input-circle" placeholder="@lang('Vehicle Plate')" onchange="$(this).val($(this).val().toUpperCase())" onkeypress="$(this).addClass('text-uppercase')">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="engine_number" class="col-md-4 control-label">@lang('Engine')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-credit-card"></i>
                                            <input id="engine_number" class="form-control input-circle" name="engine_number" placeholder="@lang('Engine Number')">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="chassis_number" class="col-md-4 control-label">@lang('Chassis')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-credit-card"></i>
                                            <input id="chassis_number" class="form-control input-circle" name="chassis_number" placeholder="@lang('Chassis Number')">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="model" class="col-md-4 control-label">@lang('Model')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-tag"></i>
                                            <input id="model" type="number" min="1950" max="2030" class="form-control input-circle" name="model" placeholder="@lang('Vehicle Model')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color" class="col-md-2 control-label">@lang('Color')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-paint-brush"></i>
                                            <input id="color" class="form-control input-circle" name="color" placeholder="@lang('Vehicle Color')">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="registration_city" class="col-md-2 control-label">@lang('City')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class=" icon-pointer"></i>
                                            <input id="registration_city" class="form-control input-circle" name="registration_city" placeholder="@lang('Registration City')">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cars_type_id" class="col-md-2 control-label">@lang('Type')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-ticket"></i>
                                            <select id="cars_type_id" class="form-control input-circle select2" name="cars_type_id" title="@lang('Vehicle Type')">
                                                @foreach( \App\CarsType::all()->sortBy('id') as $carType )
                                                    <option value="{{ $carType->id }}">{{ $carType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cars_state_id" class="col-md-2 control-label">@lang('State')</label>
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="icon-wrench"></i>
                                            <select id="cars_state_id" class="form-control input-circle select2" name="cars_state_id" title="@lang('Vehicle State')">
                                                @foreach( \App\CarsState::all()->sortBy('id') as $carState )
                                                    <option value="{{ $carState->id }}">{{ $carState->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-proprietary" class="step-pane row" data-step="3">
                            <div class="form-group">
                                <label for="identity_type" class="col-md-4 control-label">@lang('Identity type')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="fa fa-ticket"></i>
                                        <select id="identity_type" class="form-control input-circle select2" name="identity_type" title="@lang('Identity type')">
                                            <option value="CC">CC</option>
                                            <option value="NIT">NIT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="identity" class="col-md-4 control-label">@lang('Identity')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="icon-credit-card"></i>
                                        <input id="identity" class="form-control input-circle" name="identity" placeholder="@lang('Proprietary Identity')">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">@lang('Name')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="icon-user"></i>
                                        <input id="name" class="form-control input-circle" name="name" placeholder="@lang('Proprietary Name')">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">@lang('Address')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="icon-map"></i>
                                        <input id="address" class="form-control input-circle" name="address" placeholder="@lang('Proprietary Address')">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">@lang('Phone')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="fa fa-phone"></i>
                                        <input id="phone" class="form-control input-circle" name="phone" placeholder="@lang('Proprietary Phone')">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">@lang('Email')</label>
                                <div class="col-md-4">
                                    <div class="input-icon">
                                        <i class="fa fa-envelope"></i>
                                        <input id="email" name="email" type="email" class="form-control input-circle" placeholder="@lang('Proprietary Email')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="actions">
                        <button type="button" class="btn btn-default btn-circle btn-sm btn-outline sbold btn-prev">
                            <span class="glyphicon glyphicon-arrow-left"></span> @lang('Prev')
                        </button>
                        <button type="button" class="btn btn-info btn-circle btn-sm green-haze btn-outline btn-next" data-last="@lang('Save')"> @lang('Next')
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="application/javascript">
    var formCreate = $('#form-create');
    var formWizardInventory = $('#wizard-create');

    var error = $('.alert-danger', formCreate);
    //var success = $('.alert-success', formCreate);

    // Validate form Inventory
    formCreate.validate({
        doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        messages: {
            /* For inventory container */
            admission_reason_id: {
                required: "Especifique el motivo de ingreso",
            },

            /* For vehicle container */
            plate: {
                required: "Ingrese la placa del vehículo",
                minlength: jQuery.validator.format("Debe ser de {0} caracteres"),
                maxlength: jQuery.validator.format("Debe ser de {0} caracteres")
            },
            engine_number: {
                required: "Se requiere el número del motor",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            chassis_number: {
                required: "Se requiere el número del chasis",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            model: {
                required: "Especifique el modelo del vehículo",
                number: "Solo debe contener dígitos",
                range: jQuery.validator.format("Debe estar entre {0} y {1}")
            },
            color: {
                required: "Especifique el color del vehículo",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            registration_city: {
                required: "Ingrese la ciudad de registro",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            cars_type_id: {
                required: "Especifique el tipo de vehículo",
                number: "Solo debe contener dígitos"
            },
            cars_state_id: {
                required: "Especifique el estado del vehículo",
                number: "Solo debe contener dígitos"
            },

            /* For Proprietary container */
            identity_type: {
                required: "Seleccione el tipo de identificación del Propietario",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            identity: {
                required: "Ingrese la identificación del Propietario",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            name: {
                required: "Ingrese el nombre del Propietario",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            address: {
                required: "Ingrese la dirección de residencia",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            phone: {
                required: "Ingrese un teléfono",
                maxlength: jQuery.validator.format("No debe exceder los {0} caracteres")
            },
            email: {
                email: "Debe ser un tipo de email válido"
            },
            'checkboxes2[]': {
                required: 'Please check some options',
                minlength: jQuery.validator.format("At least {0} items must be selected"),
            }
        },
        rules: {
            /* For inventory container */
            admission_reason_id: {
                required: true
            },

            /* For vehicle container */
            plate: {
                required: true,
                minlength: 7,
                maxlength: 7
            },
            engine_number: {
                required: true,
                maxlength: 45
            },
            chassis_number: {
                required: true,
                maxlength: 45
            },
            model: {
                required: true,
                number: true,
                range: [1950, 2030]
            },
            color: {
                required: true,
                maxlength: 20
            },
            registration_city: {
                required: true,
                maxlength: 45
            },
            cars_type_id: {
                required: true,
                number: true
            },
            cars_state_id: {
                required: true,
                number: true
            },

            /* For Proprietary container */
            identity_type: {
                required: true,
                maxlength: 10
            },
            identity: {
                required: true,
                maxlength: 20
            },
            name: {
                required: true,
                maxlength: 45
            },
            address: {
                required: true,
                maxlength: 100
            },
            phone: {
                required: false,
                maxlength: 45
            },
            email: {
                required: false,
                email: true
            }
        },

        invalidHandler: function (event, validator) { //display error alert on form submit
            App.scrollTo(error, -200);
        },

        errorPlacement: function (error, element) {
            var icon = $(element).parent('.input-icon').children('i');
            icon.addClass("fa-warning");
            icon.attr("data-original-title", error.text()).tooltip();
        },

        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error').removeClass('has-success'); // set error class to the control group
        },

        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-successs'); // set error class to the control group
        },

        success: function (label,element) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            var icon = $(element).parent('.input-icon').children('i');
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            icon.removeClass("fa-warning");
        },

        submitHandler: function () {
        }
    });

    // Init Form Wizard
    formWizardInventory.wizard()
    .on('actionclicked.fu.wizard', function (evt, data) {
        if (data.direction === 'next' && !formCreate.valid()) {
            evt.preventDefault();
        }
    })
    .on('finished.fu.wizard', function () {
        if (formCreate.valid()) {
            formCreate.submit();
        }
    });

    formCreate.submit(function(event){
        event.preventDefault();
        var modalCreate = $('#ajax-modal-car-process');
        App.blockUI({
            target: modalCreate,
            animate: true
        });

        $.ajax({
            url: $(this).attr('action'),
            type:'post',
            data:$(this).serialize(),
            dataType: 'json',
            success:function (data) {
                if(data.success){
                    toastr["success"]("Registro creado exitósamente", "Información");
                    modalCreate.modal('hide');
                    setTimeout(function(){
                        Inventory.loadPhaseContainer($('#phase-1').find('.phase-container'));
                    },500);
                }else{
                    toastr['warning'](data.message, '@lang('Error'). Contacte a su administrador');
                }
            },
            error:function (error) {
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
                App.unblockUI(modalCreate);
            }
        });
    });

    // Init Selects
    $(".select2").select2({
        placeholder: '@lang('Select an option')',
        allowClear: true,
        width: 'auto',
        language: "es"
    });
</script>