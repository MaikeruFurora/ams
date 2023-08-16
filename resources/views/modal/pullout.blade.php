<form 
    id="FormPullout"
    method="POST"
    action="{{ route("authorize.pullout.store") }}"
    data-url="{{ route('authorize.pullout.form',['pullout'=>'sample']) }}"
    autocomplete="off">
    <div class="modal fade" id="modalstatusChange" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalstatusChangeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header px-1 py-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-1">@csrf
                    <table class="table adjust table-sm table-bordered" id="pulloutAssetTbl">
                        <thead class="st-header-table">
                            <tr>
                                <td>#</td>
                                <td>Asset Code</td>
                                <td>Item Name</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <div class="form-group">
                        <label for="status">Remarks</label>
                        <textarea name="remarks" id="" cols="30" rows="5" maxlength="500" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer p-1">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>