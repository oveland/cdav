<form action="{{ route('store-inventory') }}" class="form" id="form-create-inventory" method="post">
    {{ csrf_field() }}
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-plus-circle font-red"></i>
                <span class="caption-subject font-red bold uppercase">@lang('Create New')</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="row">
                <div class="col-md-4">
                    <strong class="text-success f-s-18 click" data-toggle="collapse" data-target="#inventory-container">
                        <i class=" icon-layers font-red"></i> @lang('Inventory')
                    </strong>
                    <div id="inventory-container" class="form-body p-0 collapse in">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="number" value="">
                            <label for="number">@lang('Number')</label>
                            <span class="help-block">@lang('Inventary Number')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control" name="admission_reason_id">
                                <option value=""></option>
                                <option value="1">Ingreso por Lesiones</option>
                                <option value="2">Ingreso por Homicidio</option>
                                <option value="3">Ingreso por Contravención</option>
                                <option value="4">Ingreso por Embargo</option>
                            </select>
                            <label for="admission_reason_id">@lang('Admission Reason')</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <strong class="text-success f-s-18 click" data-toggle="collapse" data-target="#vehicle-container">
                        <i class="fa fa-car font-red"></i> @lang('Vehicle')
                    </strong>
                    <div id="vehicle-container" class="form-body p-0 collapse in">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="plate" value="">
                            <label for="plate">@lang('Plate')</label>
                            <span class="help-block">@lang('Vehicle Plate')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="engine_number" value="">
                            <label for="engine_number">@lang('Engine')</label>
                            <span class="help-block">@lang('Engine Number')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="chassis_number" value="">
                            <label for="chassis_number">@lang('Chassis')</label>
                            <span class="help-block">@lang('Chassis Number')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input min="1950" max="2030" class="form-control" name="model" value="">
                            <label for="model">@lang('Model')</label>
                            <span class="help-block">@lang('Vehicle Model')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="color" value="">
                            <label for="color">@lang('Color')</label>
                            <span class="help-block">@lang('Vehicle Color')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="registration_city" value="">
                            <label for="registration_city">@lang('City')</label>
                            <span class="help-block">@lang('Registration City')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label has-info">
                            <select class="form-control" name="cars_state_id">
                                <option value=""></option>
                                <option value="1">Bueno</option>
                                <option value="2">Regular</option>
                                <option value="3">Malo</option>
                            </select>
                            <label for="cars_state_id">@lang('State')</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <strong class="text-success f-s-18 click" data-toggle="collapse" data-target="#proprietary-container">
                        <i class="fa fa-user font-red"></i> @lang('Proprietary')
                    </strong>
                    <div id="proprietary-container" class="form-body p-0 collapse in">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="identity" value="">
                            <label for="identity">@lang('Identity')</label>
                            <span class="help-block">@lang('Proprietary Identity')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="name" value="">
                            <label for="name">@lang('Name')</label>
                            <span class="help-block">@lang('Proprietary Name')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="address" value="">
                            <label for="address">@lang('Address')</label>
                            <span class="help-block">@lang('Proprietary Address')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input class="form-control" name="phone" value="">
                            <label for="phone">@lang('Phone')</label>
                            <span class="help-block">@lang('Proprietary Phone')</span>
                        </div>

                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="email" class="form-control" name="email" value="">
                            <label for="email">@lang('Email')</label>
                            <span class="help-block">@lang('Proprietary Email')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-circle yellow-mint btn-outline sbold uppercase" type="button" data-dismiss="modal">@lang('Cancel')</button>
        <button class="btn btn-circle green-haze btn-outline sbold">@lang('Save')</button>
    </div>
</form>

<script>
        var formCreate = $('#form-create-inventory');
        var error1 = $('.alert-danger', formCreate);
        var success1 = $('.alert-success', formCreate);

        formCreate.validate({
            onsubmit: true,
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            messages: {
                /* For inventory container */
                number: {
                    required: "El número de inventario es requerido",
                    number: "Solo debe contener dígitos"
                },
                admission_reason_id: {
                    required: "Especifique el motivo de ingreso",
                },

                /* For plate container */
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
                cars_state_id: {
                    required: "Especifique el estado del vehículo",
                    number: "Solo debe contener dígitos"
                },

                /* For Proprietary container */
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
                number: {
                    required: true,
                    number: true
                },
                admission_reason_id: {
                    required: true
                },

                /* For plate container */
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
                    range: [1990, 2030]
                },
                color: {
                    required: true,
                    maxlength: 20
                },
                registration_city: {
                    required: true,
                    maxlength: 45
                },
                cars_state_id: {
                    required: true,
                    number: true
                },

                /* For Proprietary container */
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
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            errorPlacement: function (error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                event.preventDefault();

                var modalCreate = $('#ajax-modal-car-process');
                App.blockUI({
                    target: modalCreate,
                    animate: true
                });

                success1.show();
                error1.hide();
                $.ajax({
                    url: $(form).attr('action'),
                    type:'post',
                    data:$(form).serialize(),
                    success:function (data) {
                        toastr["success"]("Registro creado exitósamente", "Información");
                        modalCreate.modal('hide');
                        setTimeout(function(){
                            Inventory.loadPhaseContainer($('#phase-1').find('.phase-container'));
                        },500);
                    },
                    error:function (error) {
                        var message = "Ocurrió un error al crear el registro. Contacte a su administrador";
                        try{
                            var errors = JSON.parse(error.responseText);
                            message = "Algunos campos no cumplen con lo requerido:<br>";
                            message += "<ul>";
                            $.each(errors,function (i,e) {
                                message += "<li>"+e[0]+"</li>";
                            });
                            message += "</ul>";
                        }catch(e){}
                        toastr["error"](message, "Error");
                    },
                    complete:function () {
                        App.unblockUI(modalCreate);
                    }
                });
            }
        });
</script>