<div class="modal fade" id="modalViewMyAsset" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalViewMyAssetLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2" style="background: #76b8db">
                <p class="modal-title" id="modalViewMyAssetLabel"><b>Assigned Accountable Asset</b></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-1">
                <table id="assignedAccountTable" class="table table-bordered table-sm"
                data-url="{{ route("authorize.user.assign.list") }}" style="width: 100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Control Number</th>
                            <th>Serial No</th>
                            <th>Item name</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer px-1 py-1">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>