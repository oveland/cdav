@php $inventoryFiles = $inventory->files @endphp
<div class="portlet-body">
    @if( $inventoryFiles && $inventoryFiles->count() > 0 )
        @php $idPortfolio = 'cube-portfolio' @endphp
        <div class="portfolio-content portfolio-4 col-md-12">
            <div id="filters-{{ $idPortfolio }}" class="cbp-l-filters-alignCenter">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item text-uppercase">
                    <i class="icon-layers"></i> @lang('All')
                    <div class="cbp-filter-counter"></div>
                </div> /
                <div data-filter=".inventory-images" class="cbp-filter-item text-uppercase">
                    <i class="fa fa-picture-o"></i> @lang('Images')
                    <div class="cbp-filter-counter"></div>
                </div> /
                <div data-filter=".inventory-documents" class="cbp-filter-item text-uppercase">
                    <i class="fa fa-files-o"></i> @lang('Documents')
                    <div class="cbp-filter-counter"></div>
                </div>
                <a class="btn btn-circle btn-icon-only btn-default pull-right p-t-10" href="javascript:Inventory.refreshPanelFiles()" style="top: -10px !important;">
                    <i class="fa fa-refresh"></i>
                </a>
            </div>
            <div id="{{ $idPortfolio }}" class="cbp">
                @foreach($inventoryFiles as $inventoryFile)
                    <div class="cbp-item identity inventory-{{ $inventoryFile->getCategory() }}" style="width: 50px !important;">
                        <a href="{{ route('inventory-file-image',['inventoryFile'=> $inventoryFile->id]) }}" class="cbp-caption cbp-lightbox"
                           data-title="
                                    <strong>@lang('Name'): </strong>{{ $inventoryFile->name }}<br><strong>@lang('Created at'): </strong>{{ $inventoryFile->created_at }}
                                   <div class='m-t-5 m-b-10 image-actions image-actions-preview pull-right'>
                                       <a href='{{ route('inventory-file-download',['inventoryFile'=> $inventoryFile->id]) }}' class='btn btn-circle btn-icon-only yellow btn-outline'
                                           data-toggle='tooltip' title='@lang('Download')'>
                                            <i class='fa fa-download'></i>
                                        </a>
                                        <a href='{{ route('inventory-file-preview',['inventoryFile'=> $inventoryFile->id]) }}' class='btn btn-circle btn-icon-only green btn-outline' target='_blank'
                                           data-toggle='tooltip' title='@lang('Preview')'>
                                            <i class='icon-crop'></i>
                                        </a>
                                        <button data-action='{{ route('inventory-file-form-delete',['inventoryFile' => $inventoryFile->id]) }}' class='btn btn-circle btn-icon-only red btn-outline btn-delete-inventory-file' data-toggle='tooltip' title='@lang('Delete')'>
                                            <i class='fa fa-times'></i>
                                        </button>
                                    </div>"
                        >
                            <div class="cbp-caption-defaultWrap">
                                <img src="{{ route('inventory-file-image',['inventoryFile'=> $inventoryFile->id]) }}?thumbnail=true" alt="">
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignLeft">
                                    <div class="cbp-l-caption-body">
                                        <div class="cbp-l-caption-title">{{ str_limit($inventoryFile->name, 10) }}</div>
                                        <div class="cbp-l-caption-desc">
                                            {{ $inventoryFile->created_at }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="m-t-5 m-b-10 text-center image-actions">
                            <a href="{{ route('inventory-file-download',['inventoryFile'=> $inventoryFile->id]) }}" class="btn btn-circle btn-icon-only yellow btn-outline"
                               data-toggle="tooltip" title="@lang('Download')">
                                <i class="fa fa-download"></i>
                            </a>
                            <a href="{{ route('inventory-file-preview',['inventoryFile'=> $inventoryFile->id]) }}" class="btn btn-circle btn-icon-only green btn-outline" target="_blank"
                               data-toggle="tooltip" title="@lang('Preview')">
                                <i class="icon-crop"></i>
                            </a>
                            <button data-action="{{ route('inventory-file-form-delete',['inventoryFile' => $inventoryFile->id]) }}" class="btn btn-circle btn-icon-only red btn-outline btn-delete-inventory-file" data-toggle="tooltip" title="@lang('Delete')">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @else
        <a class="btn btn-circle btn-icon-only btn-default pull-right p-t-10" href="javascript:Inventory.refreshPanelFiles()" style="top: -10px !important;">
            <i class="fa fa-refresh"></i>
        </a>
        <div class="col-md-6 col-md-offset-3 m-t-15 alert alert-danger alert-dismissable text-center fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <div class="col-md-12">
                <i class="fa fa-exclamation-circle f-s-24"></i>
            </div>
            <p>@lang('Not files found')</p>
        </div>
    @endif
</div>

<script type="application/javascript">
    $(document).ready(function () {
        @if(isset($idPortfolio))
        $('#{{ $idPortfolio }}').cubeportfolio({
            filters: '#filters-{{ $idPortfolio }}',
            layoutMode: 'mosaic',
            sortToPreventGaps: true,
            defaultFilter: '*',
            animationType: 'rotateSides',
            gapHorizontal: 0,
            gapVertical: 0,
            gridAdjustment: 'responsive',
            caption: 'zoom',
            displayType: 'bottomToTop',
            displayTypeSpeed: 100,
            mediaQueries: [{
                width: 800,
                cols: 5
            }, {
                width: 600,
                cols: 2
            }, {
                width: 200,
                cols: 1
            }],

            // lightbox
            lightboxDelegate: '.cbp-lightbox',
            lightboxGallery: true,
            lightboxTitleSrc: 'data-title',
            lightboxCounter: '<div class="cbp-popup-lightbox-counter">\{\{current\}\} de \{\{total\}\}</div>'
        }).on('initComplete.cbp', function () { // Required tab active for initialize plugin successfully
            if ($('#tab-general').hasClass('active')) $('#tab-files').removeClass('active'); // Inactive tab once the plugin initialized
            $('[data-toggle="tooltip"]').tooltip();
        }).on('updateSinglePageComplete.cbp', function () { // Required tab active for initialize plugin successfully
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#ajax-modal-car-detail').on('hidden.bs.modal', function () {
            try {
                $('#{{ $idPortfolio }}').cubeportfolio('destroy');
            } catch (e) {
            }
        });
        @endif
    });
</script>