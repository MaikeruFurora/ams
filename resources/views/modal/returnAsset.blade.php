<form  id="FormReturn"  method="POST"
    {{-- action="{{ route("authorize.pullout.store") }}"
    data-url="{{ route('authorize.pullout.form',['pullout'=>'sample']) }}" --}}
    autocomplete="off">@csrf
    <x-modal  id="returnAssetModal"  name="Return Asset">
        <table class="table adjust table-bordered" id="returnAssetTbl">
            <thead class="st-header-table">
                <tr>
                    <td>#</td>
                    <td>Asset Code</td>
                    <td>Item Name</td>
                    <td>Status</td>
                    <td>Remarks</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </x-modal>
</form>
