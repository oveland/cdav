<div class="portlet light m-b-0">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-bell font-red"></i>
            <span class="caption-subject font-red bold uppercase">@lang('Send notification')</span>
        </div>

        <div class="actions pull-right">
            <a class="btn btn-circle red-mint btn-outline sbold btn-icon-only" data-dismiss="modal" title="@lang('Close')">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <form action="{{ route('inventory-ajax','startNextEstrangementProcess') }}?id={{ $inventoryProcess->id }}" class="form-process">
            <blockquote>
                <p> @lang('Write a description for notification')</p>
                <div class="mt-element-overlay">
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="observations" placeholder="@lang('Observations')" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </blockquote>

            <div class="modal-footer col-md-12 m-t-10">
                {{ csrf_field() }}
                <button type="button" class="btn btn-circle yellow-mint btn-outline sbold uppercase" data-dismiss="modal">
                    @lang('Cancel')
                </button>
                <button class="btn btn-circle yellow btn-outline sbold uppercase">
                    <i class="fa fa-envelope"></i> @lang('Send')
                </button>
            </div>
        </form>
    </div>
</div>

<script type="application/javascript">
    $('.form-process').submit(function (event) {
        event.preventDefault();
        var container = $(this).parents('.portlet');
        App.blockUI({
            target: container,
            animate: true
        });

        var formButton = $(this).find('button[type="submit"]');
        formButton.addClass('disabled');
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'GET',
            success: function (data) {
                if (data === 'success') toastr['success']('@lang('Notificación enviada correctamente')', '@lang('Information')');
                else toastr['warning']('@lang('No ha sido posible enviar la notificación')', '@lang('Ups')');
            },
            error: function () {
                toastr['error']('@lang('Oops, something went wrong!')', '@lang('Error')');
            },
            complete: function () {
                Inventory.loadPhaseContainer($('#phase-3').find('.phase-container'))
                formButton.removeClass('disabled');
                App.unblockUI(container);
                $('#ajax-modal-send-mail-notification').modal('hide');
            }
        });
    });
</script>