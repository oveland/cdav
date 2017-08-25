<div class="portlet light m-b-0">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-trash-o font-red"></i>
            <span class="caption-subject font-red bold uppercase">@lang('Delete inventory file')</span>
        </div>

        <div class="actions pull-right">
            <a class="btn btn-circle red-mint btn-outline sbold btn-icon-only" data-dismiss="modal" title="@lang('Close')">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <blockquote>
            <p> @lang('Confirm that do yoy want delete the file:')</p>
            <div class="mt-element-overlay">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="mt-overlay-6">
                            <img src="{{ route('inventory-image-file',['inventoryFile'=> $inventoryFile->id]) }}?thumbnail=true"/>
                            <div class="mt-overlay">
                                <h2 style="text-transform: none !important;">{{ $inventoryFile->name }}</h2>
                                <p>
                                    <a class="mt-info uppercase btn default btn-outline" href="{{ route('inventory-file-preview',['inventoryFile'=> $inventoryFile->id]) }}" target="_blank">
                                        @lang('Preview')
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </blockquote>

        <div class="modal-footer col-md-12 m-t-10">
            <form action="{{ route('inventory-file-delete',['inventoryFile'=>$inventoryFile->id]) }}"
                  class="form-file-delete">
                {{ csrf_field() }}
                <button type="button" class="btn btn-circle yellow-mint btn-outline sbold uppercase"
                        data-dismiss="modal">@lang('Cancel')</button>
                <button class="btn btn-circle red-flamingo btn-outline sbold uppercase">
                    <i class="fa fa-trash"></i> @lang('Delete')
                </button>
            </form>
        </div>
    </div>
</div>

<script type="application/javascript">
    $('.form-file-delete').submit(function (event) {
        event.preventDefault();
        var container = $(this).parents('.portlet');
        App.blockUI({
            target: container,
            animate: true
        });

        var btnDelete = $(this).find('button[type="submit"]');
        btnDelete.addClass('disabled');
        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            success: function (data) {
                if (data === 'success') toastr['success']('@lang('File deleted successfully')', '@lang('Information')');
                else toastr['warning']('@lang('File not deleted successfully')', '@lang('Ups')');
            },
            error: function () {
                toastr['error']('@lang('Oops, something went wrong!')', '@lang('Error')');
            },
            complete: function () {
                btnDelete.removeClass('disabled');
                $('#ajax-modal-delete-file').modal('hide');
                Inventory.refreshPanelFiles();
                App.unblockUI(container);
            }
        });
    });
</script>