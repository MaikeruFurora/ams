<form id="FormPullout" method="POST" action="{{ route("authorize.pullout.store") }}" autocomplete="off">
    <div class="modal fade" id="modalstatusChange" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalstatusChangeLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header px-1 py-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-1">@csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="asset">
                    <input type="hidden" name="user">
                    <div class="form-group">
                        <label for="">Asset Code</label>
                        <input type="text" name="asset_code" class="form-control form-control-sm" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="custom-select custom-select-sm">
                            @foreach ($assetStatus as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Remarks</label>
                        <textarea name="remarks" id="" cols="30" rows="5" class="form-control"></textarea>
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