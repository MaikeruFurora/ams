<div class="modal fade" id="modalSupplier" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalSupplierLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <form id="FormSupplier" action="{{ route("authorize.supplier.store") }}" autocomplete="off">@csrf
            <div class="modal-content">
            <div class="modal-header px-1 py-1">
                <p class="modal-title" id="modalSupplierLabel">Create New</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                    <div class="form-group">
                    <label for="supplier">Supplier Name</label>
                    <input type="hidden" name="id">
                    <input type="text" class="form-control form-control-sm" id="supplier" name="name" maxlength="50">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                </div>
                <div class="modal-footer px-1 py-1">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>