<div class="modal fade" id="{{ $id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-1 py-1">
                <span class="ml-2">{{ $name }}</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-1">
               {{ $slot }}
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>