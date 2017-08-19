@extends('layouts.app')

@section('stylesheets')
    <!--||| ********** BEGIN PAGE LEVEL PLUGINS ********** -->
    <!-- MODALS -->
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />

    <!-- DATA TABLES -->
    <link href="../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

    <!--||| ********** END PAGE LEVEL PLUGINS ********** -->
@endsection

@section('content')

    <!-- BEGIN PAGE TITLE-->
    <h3 class="page-title"></h3>
    <!-- END PAGE TITLE-->

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">@lang('Inventories')</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="mt-element-step">
                        <div class="row step-line">
                            <div class="mt-step-desc text-center hide">
                                <div class="font-dark bold uppercase">@lang('Process Inventory')</div>
                                <div class="caption-desc font-grey-cascade">
                                </div>
                                <br/>
                            </div>
                            <div class="phases col-md-4 mt-step-col first phase-inventory done" data-toggle="tab" href="#phase-1" data-active="done">
                                <div class="mt-step-number bg-white">
                                    <i class=" icon-layers done"></i>
                                </div>
                                <div class="mt-step-title uppercase font-grey-cascade">@lang('Phase') 1</div>
                                <div class="mt-step-content font-grey-cascade">@lang('Inventory Register')</div>
                            </div>
                            <div class="phases col-md-4 mt-step-col phase-inventory" data-toggle="tab" href="#phase-2" data-active="active">
                                <div class="mt-step-number bg-white">
                                    <i class="fa fa-sign-out active"></i>
                                </div>
                                <div class="mt-step-title uppercase font-grey-cascade">@lang('Phase') 2</div>
                                <div class="mt-step-content font-grey-cascade">@lang('Abandonment Declaration')</div>
                            </div>
                            <div class="phases col-md-4 mt-step-col last phase-inventory" data-toggle="tab" href="#phase-3" data-active="error">
                                <div class="mt-step-number bg-white">
                                    <i class="fa fa-tags error"></i>
                                </div>
                                <div class="mt-step-title uppercase font-grey-cascade">@lang('Phase') 3</div>
                                <div class="mt-step-content font-grey-cascade">@lang('Alienation Process')</div>
                            </div>
                        </div>
                        <hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div id="phase-1" class="tab-pane fade in active">
                                    <div class="portlet light bordered phase-container" data-url="{{ route('ajax-inventory','loadPhase1Table') }}"></div>
                                </div>
                                <div id="phase-2" class="tab-pane fade">
                                    <div class="portlet light bordered phase-container" data-url="{{ route('ajax-inventory','loadPhase2Table') }}"></div>
                                </div>
                                <div id="phase-3" class="tab-pane fade">
                                    <div class="portlet light bordered phase-container" data-url="{{ route('ajax-inventory','loadPhase3Table') }}"></div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="ajax-modal-car-process" class="bootbox modal fade modal-scroll" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="860"></div>
@endsection
@section('javascripts')

    <!--||| ********** BEGIN PAGE LEVEL PLUGINS ********** -->
    <!-- MODALS -->
    <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

    <!-- DATA TABLES -->
    <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

    <!-- FORM VALIDATIONS -->
    <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

    <!--||| ********** END PAGE LEVEL PLUGINS ********** -->

    <script type="application/javascript">
        $(document).ready(function(){
            $('.phases').on('click',function () {
                var el = $(this);
                $('.phases').removeClass('done active error');
                el.addClass( $(this).data('active') );
                setTimeout(function(){
                    Inventory.loadPhaseContainer( $( el.attr('href') ).find('.phase-container') )
                },200);
            });

            $('.phase-container').each(function(i,e){
                var el = $(e);
                Inventory.loadPhaseContainer(el);
            });

            $('body').on('click','.ajax-btn-car-process', function(){
                var $modal = $('#ajax-modal-car-process');
                $modal.modal('hide');
                // create the backdrop and wait for next modal to be triggered
                $('body').modalmanager('loading');
                $modal.load($(this).attr('data-action'), '', function(){
                    $modal.modal();
                });
            }).on('click', '.ajax-btn-process-next-phase', function () {
                var el = $(this).parents('.phase-container');
                // create the backdrop and wait for next modal to be triggered
                App.blockUI({
                    target: el,
                    animate: true
                });
                $.ajax({
                    url: $(this).attr('data-action'),
                    data:{},
                    complete:function () {
                        Inventory.loadPhaseContainer(el);
                    }
                });
            });
        });

        var Inventory = function () {
            return {
                loadPhaseContainer: function (el) {
                    var url = el.data('url');
                    App.blockUI({
                        target: el,
                        animate: true
                    });
                    el.load(url, function () {
                        App.unblockUI(el);
                    });
                },
                initPhaseTable: function (table) {
                    // begin: third table
                    table.dataTable({
                        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                        "language": {
                            "aria": {
                                "sortAscending": ": Orden Ascendente",
                                "sortDescending": ": Orden Descendente"
                            },
                            "emptyTable": "No se encontraron registros",
                            "info": "Registros _START_ a _END_ de _TOTAL_ en total",
                            "infoEmpty": "No se encontraron registros",
                            "infoFiltered": "(_MAX_ resultados encontrados)",
                            "lengthMenu": "Mostrar: _MENU_",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron registros",
                            "paginate": {
                                "previous": "Anterior",
                                "next": "Siguiente",
                                "last": "Último",
                                "first": "Primero"
                            }
                        },

                        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
                        // So when dropdowns used the scrollable div should be removed.
                        //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                        "lengthMenu": [
                            [5, 10, 15, -1],
                            [5, 10, 15, "Todos"] // change per page values here
                        ],
                        // set the initial value
                        "pageLength": 5,
                        "columnDefs": [{  // set default column settings
                            'orderable': true,
                            'targets': [0]
                        }, {
                            "searchable": true,
                            "targets": [0]
                        }],
                        "order": [
                            [1, "asc"]
                        ] // set first column as a default sort by asc
                    });
                }
            }
        }();
    </script>
@endsection