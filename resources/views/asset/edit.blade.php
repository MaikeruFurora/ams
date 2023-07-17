@extends('../layout/app')
@section('moreCss')
<input type="hidden" name="autocompleteURL" value="{{ route('authorize.autocomplete',['type'=>'Sample']) }}">
<input type="hidden" name="getsubcateURL" value="{{ route('authorize.asset.getsubcategory',['category'=>'Sample']) }}">
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Assets">
        <a href="{{ route('authorize.asset') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form id="FormAsset" action="{{ route('authorize.asset.store') }}" method="POST" autocomplete="off">@csrf
            <input type="hidden" name="id" value="{{ $asset->id }}">
            <div class="card p-0">
                <div class="card-header p-2 text-white" style="background: #76b8db">
                    <b>Form</b>
                </div>
                <div class="card-body ">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <select name="category" class="form-control form-control-sm"  data-id="{{ $asset->sub_category->category->id}}" data-name="{{ $asset->sub_category->category->name }}" ></select>
                        </div>
                        <div class="form-group col-6">
                            <select name="sub_category" class="form-control form-control-sm" data-id="{{ $asset->sub_category->id}}" data-name="{{ $asset->sub_category->name }}"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Asset Code</label>
                            <input type="text" class="form-control form-control-sm" name="asset_code" id="" maxlength="40" value="{{ $asset->asset_code }}">
                            @error('asset_code') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control form-control-sm" name="item_name" id="" maxlength="40" value="{{ $asset->item_name }}">
                                    @error('item_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Brand/Model</label>
                                    <input type="text" class="form-control form-control-sm" name="brand" id="" maxlength="40" value="{{ $asset->brand }}">
                                    @error('brand') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Serial Number</label>
                                    <input type="text" class="form-control form-control-sm" name="serial_no" id="" maxlength="40" value="{{ $asset->serial_no }}">
                                     @error('serial_no') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Product Number</label>
                                    <input type="text" class="form-control form-control-sm" name="product_no" id="" maxlength="40" value="{{ $asset->product_no }}">
                                     @error('product_no') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Purchase Order</label>
                            <input type="text" class="form-control form-control-sm" name="purchase_order" id="" value="{{ $asset->purchase_order }}" maxlength="40">
                            @error('purchase_order') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Purchase Amount</label>
                            <input type="text" class="form-control form-control-sm amount" name="purchase_amount" id="" value="{{ $asset->purchase_amount }}" maxlength="40">
                                    @error('purchase_amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Actual Amount</label>
                                    <input type="text" class="form-control form-control-sm amount" name="actual_amount" id="" value="{{ $asset->actual_amount }}">
                                    @error('actual_amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Date Purchase</label>
                                    <input type="text" class="form-control form-control-sm datepicker" name="date_purchase" id="" value="{{ $asset->date_purchase }}" maxlength="40">
                                    @error('date_purchase') <small class="text-danger">{{ $message }}</small> @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Date Recieved</label>
                                    <input type="text" class="form-control form-control-sm datepicker" name="date_recieve" id="" value="{{ $asset->date_recieve }}">
                                    @error('date_recieve') <small class="text-danger">{{ $message }}</small> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" id="" cols="20" rows="5">{{ $asset->description }}</textarea>
                                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Product Warranty</label>
                                    <input type="text" class="form-control form-control-sm" name="product_warranty" id="" maxlength="40" value="{{ $asset->product_warranty }}">
                                    @error('product_warranty') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Service Warranty</label>
                                    <input type="text" class="form-control form-control-sm" name="service_warranty" id="" maxlength="40" value="{{ $asset->service_warranty }}">
                                    @error('service_warranty') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Color</label>
                                    <input type="text" class="form-control form-control-sm" name="color" id="" value="{{ $asset->color }}">
                                    @error('color') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">UOM</label>
                                    <input type="number" class="form-control form-control-sm" name="uom" id="" min="1" max="20" value="{{ $asset->uom }}">
                                    @error('uom') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">Supplier</label>
                                    <select name="supplier" id="" class="custom-select custom-select-sm supplier" style="width:100%" data-name="{{ $asset->supplier->name }}" data-id="{{ $asset->supplier->id }}">
                                        <option selected disabled value="">Choose...</option>
                                    </select>
                                    @error('supplier') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">&nbsp;</label>
                                    <button type="button" name="create_supplier" class="btn btn-primary btn-block btn-sm"><i class="fas fa-plus-circle"></i> New</button>
                                </div>
                           </div>
                           <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label for="">Status</label>
                                    <select name="asset_status" class="custom-select custom-select-sm asset_status" style="width:100%" data-name="{{ $asset->asset_status->name }}" data-id="{{ $asset->asset_status->id }}">
                                        <option selected disabled value="">Choose...</option>
                                    </select>
                                    @error('asset_status') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">&nbsp;</label>
                                    <button type="button" name="create_asset_status" class="btn btn-primary btn-block btn-sm"><i class="fas fa-plus-circle"></i> New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1" style="background: #76b8db">
                    <div class="float-right">
                        <button type="submit" class="btn btn-sm btn-primary py-1"><i class="fas fa-paper-plane"></i> Submit</button>
                    </div>
                </div>
           </div> 
        </form>
        </div>
    </div> 
@include('modal.supplier')
@include('modal.status')
@endsection
@section('moreJs')
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-number/jquery.number.min.js') }}"></script>
<script>
    let   autocompleteURL = $("input[name=autocompleteURL]")
    let   getSubCatURL   = $("input[name=getsubcateURL]")
    let   supplier        = $('.supplier')
    let   asset_status    = $('.asset_status')
    let   sub_category    = $('select[name=sub_category]')
    let   category        = $('select[name=category]')
    sub_category.select2()
    console.log(getSubCatURL.val());
    supplier.select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'supplier'));
    asset_status.select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'status'));
    category.select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'category'))

    $(document).on('click',"button[name=create_supplier]",function(){
        Config.FormSupplier[0].reset();
        $("#modalSupplier").modal("show")
    })   

    $(document).on('click',"button[name=create_asset_status]",function(){
        Config.FormStatus[0].reset();
        $("#modalStatus").modal("show")
    })

    const selectSubCategory = (id) =>{
        $.ajax({
            url:getSubCatURL.val().split('Sample')[0]+id,
            type:'get',
        }).done(function(data){
            
            if (data.length>0) {
                hold=''
                hold+='<option selected disabled value="">Choose...</option>'
                data.forEach(element => {
                    hold+=`<option value="${element.id}" ${(element.id==id)?'selected':''}>${element.name}</option>`
                });
            }else{ hold='' }
            sub_category.html(hold)
        }).fail(function (jqxHR, textStatus, errorThrown) {
            console.log(errorThrown);
        })
    }

    category.on('change',function(){
        selectSubCategory($(this).val())
    })

    selectSubCategory(category.attr('data-id'))

    // selected option in select2
    category.append( new Option(category.attr('data-name'), category.attr('data-id'), true, true)).trigger('change');
    supplier.append( new Option(supplier.attr('data-name'), supplier.attr('data-id'), true, true)).trigger('change');
    asset_status.append( new Option(asset_status.attr('data-name'), asset_status.attr('data-id'), true, true)).trigger('change');
    
    Config.FormSupplier.on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:Config.FormSupplier.attr('action'),
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(data){
                Config.FormSupplier[0].reset();
                $("#modalSupplier").modal("hide")
            }).fail(function (jqxHR, textStatus, errorThrown) {
                console.log(errorThrown);
            })
        })

    Config.FormStatus.on('submit',function(e){
        e.preventDefault()
        $.ajax({
            url:Config.FormStatus.attr('action'),
            type:'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        }).done(function(data){
            Config.FormStatus[0].reset();
            $("#modalStatus").modal("hide")
        }).fail(function (jqxHR, textStatus, errorThrown) {
            console.log(errorThrown);
        })
        })
</script>
@endsection
