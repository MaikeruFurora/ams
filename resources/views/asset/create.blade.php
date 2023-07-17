@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Alertify css -->
<link href="{{ asset('plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('content')
<!-- Page-Title -->
<x-page-title title="create Asset">
    <a href="{{ route('authorize.asset') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    <input type="hidden" name="autocompleteURL" value="{{ route('authorize.autocomplete',['type'=>'Sample']) }}">
</x-page-title>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card p-0 mb-3">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <small> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus accusantium a minus officiis doloremque accusamus .</small>
                    </div>
                    <div class="col-8">
                        <form id="FormCreate" class="py-1">
                            <div class="form-row">
                            <div class="col-lg-4">
                                <select name="category" id="" class="js-example-responsive m-1 custom-select custom-select-sm" required></select>
                            </div>
                            <div class="col-lg-4">
                                <select name="sub_category" id="" class="m-1 custom-select custom-select-sm" required>
                                    <option selected disabled value="">Choose...</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <input type="number" name="qty" class=" form-control form-control-sm" min="1" max="10" placeholder="Quantity" style="height: 100%" required>
                            </div>
                            <div class="col-lg-1">
                                <button name="createBtn" class="btn btn-primary btn-sm btn-block">Create</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form id="FormAsset" action="{{ route('authorize.asset.store') }}" autocomplete="off">@csrf
            <div class="card p-0">
                <div class="card-header p-2 text-white" style="background: #76b8db">
                    <b>Form</b>
                </div>
                <div class="card-body pb-2">
                    <div id="showForm" data-image-url="{{ asset('assets/images/asset.svg') }}">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/asset.svg') }}" alt="" srcset="" width="100px">
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1" style="background: #76b8db">
                    <div class="float-right">
                        <button type="button" class="btn btn-sm btn-warning py-1"><i class="fas fa-redo-alt"></i> Reset</button>
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
   <!-- Required datatable js -->
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
   <!-- Alertify js -->
   <script src="{{ asset('plugins/alertify/js/alertify.js') }}"></script>
   <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
   
    <script>
        let   category        = $("select[name=category]")
        let   sub_category    = $("select[name=sub_category]")
        let   createBtn       = $("button[name=createBtn]")
        let   FormCreate      = $("form[id=FormCreate]")
        let   FormAsset       = $("form[id=FormAsset]")
        let   autocompleteURL = $("input[name=autocompleteURL]")
        let   hold            = ''
        const tabArray        = []
        FormAsset.find('.btn').prop('disabled',true)
        sub_category.select2()
        category.on('change',function(){
            $.ajax({
                url:`get-subcategory/${$(this).val()}`,
                type:'get',
            }).done(function(data){
                
                if (data.length>0) {
                    hold=''
                    hold+='<option selected disabled value="">Choose...</option>'
                    data.forEach(element => {
                        hold+=`<option value="${element.id}">${element.name}</option>`
                    });
               }else{ hold='' }
                sub_category.html(hold)
            }).fail(function (jqxHR, textStatus, errorThrown) {
                console.log(errorThrown);
            })
        })

        // createBtn.on('click',function(e){
        //     if (request_qty.val()>0) {
        //         e.preventDefault()
        //         alertify
        //             .okBtn("Proceed")
        //             .cancelBtn("Cancel")
        //             .confirm("Data will be lost once this page reloads.", function (ev) {
        //                 alertify.success("You've clicked OK");
        //                 $('#creation').submit();
        //             }, function(ev) {
        //                 e.preventDefault();
        //                 alertify.error("You've clicked Cancel");
        //             });
        //     }
        // })

        

        const resetform = () => {
            category.val('').trigger('change')
            sub_category.html(`<option selected disabled value="">Choose...</option>`).trigger('change')
            FormCreate.find('input[name="qty"]').val('')
            $("#FormCreate *").prop("disabled", false);
            $("#FormAsset *").prop("disabled",false)
            FormAsset.find('.btn').prop('disabled',true)
            hold=`<div class="text-center"><img src="${FormAsset.find('#showForm').attr('data-image-url')}" alt="" srcset="" width="100px"></div>`
            $("#showForm").html(hold)
        }

        FormCreate.on('submit',function(e){
            FormAsset.find('.btn').prop('disabled',false)
            let num = parseInt(FormCreate.find("input[name=qty]").val())
            $("#FormCreate *").prop("disabled", true);
            e.preventDefault()
            hold=''
            $("#showForm").html(`<div class="text-center"><div class="spinner-border spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div></div>`)
            setTimeout(() => {
                hold+=`<nav><div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">`
                for (let i = 0; i < num; i++) {
                    tabArray.push(i)
                    hold+=`<button class="nav-link border p-2 ${i==0?'active':''}" 
                                    id="nav-${i}-tab" data-toggle="tab"
                                    data-target="#nav-${i}"
                                    type="button"
                                    role="tab"
                                    aria-controls="nav-${i}"
                                    aria-selected="${(i==1)}">
                                <i class="fas fa-tag mr-2" style="font-size: 9px"></i>
                                ${FormCreate.find("select[name=sub_category] :selected").text().substring(0, 6)}..
                                <b class="text-danger"><i class="fas fa-times-circle ml-2 removeTab" id="${i}"></i></b>
                                </button>`
                            }
                            // ${(i!=0 || parseInt(FormCreate.find("input[name=qty]").val())==1)?`<b class="text-danger"><i class="fas fa-times-circle ml-2 removeTab" id="${i}"></i></b>`:''}
            // hold+=`<button onclick="appendTab()"  class="nav-link border bg-success text-white" data-toggle="tab" type="button" role="tab"><b><i class="fas fa-plus-circle"></i></b></button>`
            hold+=`</div></nav>`
            hold+=`<div class="tab-content" id="nav-tabContent">`
                for (let i = 0; i < num; i++) {
                    hold+=`<div class="tab-pane p-4  fade ${(i==0)?'show active':'' }" id="nav-${i}" role="tabpanel" aria-labelledby="nav-${i}-tab">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Asset Code</label>
                                        <input type="text" class="form-control form-control-sm" name="asset_code[]" id="" maxlength="40" value="${Config.date.getFullYear()}AIM">
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Item Name</label>
                                                <input type="text" class="form-control form-control-sm" name="item_name[]" id="" maxlength="40">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Brand/Model</label>
                                                <input type="text" class="form-control form-control-sm" name="brand[]" id="" maxlength="40">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Serial Number</label>
                                                <input type="text" class="form-control form-control-sm" name="serial_no[]" id="" maxlength="40">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Product Number</label>
                                                <input type="text" class="form-control form-control-sm" name="product_no[]" id="" maxlength="40">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Purchase Order</label>
                                        <input type="text" class="form-control form-control-sm" name="purchase_order[]" id="" maxlength="40">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Purchase Amount</label>
                                        <input type="text" class="form-control form-control-sm amount" name="purchase_amount[]" id="" maxlength="40">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Actual Amount</label>
                                                <input type="text" class="form-control form-control-sm amount" name="actual_amount[]" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Date Purchase</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="date_purchase[]" id="" maxlength="40">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Date Recieved</label>
                                                <input type="text" class="form-control form-control-sm datepicker" name="date_recieve[]" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Description</label>
                                        <textarea class="form-control" name="description[]" id="" cols="20" rows="5"></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Product Warranty</label>
                                                <input type="text" class="form-control form-control-sm" name="product_warranty[]" id="" maxlength="40">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Service Warranty</label>
                                                <input type="text" class="form-control form-control-sm" name="service_warranty[]" id="" maxlength="40">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Color</label>
                                                <input type="text" class="form-control form-control-sm" name="color[]" id="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">UOM</label>
                                                <input type="number" class="form-control form-control-sm" name="uom[]" id="" min="1" max="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="">Supplier</label>
                                                <select name="supplier[]" id="" class="custom-select custom-select-sm supplier" style="width:100%">
                                                    <option selected disabled value="">Choose...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">&nbsp;</label>
                                                <button type="button" name="create_supplier" class="btn btn-primary btn-block btn-sm"><i class="fas fa-plus-circle"></i> New</button>
                                            </div>
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group col-md-9">
                                                <label for="">Status</label>
                                                <select name="asset_status[]" id="" class="custom-select custom-select-sm asset_status" style="width:100%">
                                                    <option selected disabled value="">Choose...</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="">&nbsp;</label>
                                                <button type="button" name="create_asset_status" class="btn btn-primary btn-block btn-sm"><i class="fas fa-plus-circle"></i> New</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        }
                hold+=`</div>`
                $("#showForm").html(hold)
                initailizeSelect2()
            }, 500);
            
        })

        $(document).on('click',"button[name=create_supplier]",function(){
            Config.FormSupplier[0].reset();
            $("#modalSupplier").modal("show")
        })

        $(document).on('click',"button[name=create_asset_status]",function(){
            Config.FormStatus[0].reset();
            $("#modalStatus").modal("show")
        })

        /**
         * SELECT2 SETUP 
         **/
        function initailizeSelect2(){
            $('.supplier').each(function(index, element) {
                $(this).select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'supplier'));
            })
            $('.asset_status').each(function(index, element) {
                $(this).select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'status'));
            });
            $('.amount').number( true, 4 );
            $(".datepicker").datepicker({
            toggleActive: true,
            autoclose: true
        })
        }
        
        $("select[name=category]").select2(Config.selectData(autocompleteURL.val().split('Sample')[0]+'category'))

        // creation supplier

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

        FormAsset.on('submit',function(e){
            e.preventDefault()

            let form = FormAsset[0]
            let formData = new FormData(form);
            formData.append('qty',FormCreate.find('input[name=qty]').val())
            formData.append('category',category.find(':selected').val())
            formData.append('sub_category',sub_category.find(':selected').val())
            console.log(category.find(':selected').val());
            console.log(sub_category.find(':selected').val());
            $.ajax({
                url:FormAsset.attr('action'),
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend:function(data){
                    $("#FormAsset *").prop("disabled",true)
                }
            }).done(function(data){
                resetform()
                alertify.alert("Successfully Saved")
            }).fail(function (jqxHR, textStatus, errorThrown) {
                alertify.alert("Please check the all fields.", function(){
                    $("#FormAsset *").prop("disabled",false)
                    alertify.okBtn("ok")
                });
                $.each(jqxHR.responseJSON.errors , function( key, value ) {
                    console.log(key);
                    // let elem = $("."+key)
                    // elem.text("dsadada")
                });
            })
        })

        $(document).on('click','.removeTab',function(){
            let num   = FormCreate.find("input[name=qty]") 
            let id    = $(this).attr("id")
            alertify.okBtn("Proceed")
            .cancelBtn("Cancel")
            .confirm("Remove this tab", function (ev) {
                        num.val(parseInt(num.val())-1)
                        tabArray.splice(tabArray.indexOf(parseInt(id)),1)
                        $("#nav-"+id+"-tab").remove()
                        $("#nav-"+id).remove()
                        $("#nav-"+tabArray[0]+"-tab").addClass("active")
                        $("#nav-"+tabArray[0]+"").addClass("show active")
                        if ((parseInt(num.val())-1)<0) {
                            resetform()
                            tabArray.length=0
                        }
                    }, function(ev) {
                        alertify.error("You've clicked Cancel");
                    });
        })

        const appendTab = () =>{
            console.log(tabArray[tabArray.length-1]);
        }
    

        window.onbeforeunload = function(e) {

            if (parseInt(FormCreate.find("input[name=qty]").val())>0) {
               if (confirm("Your data will disappear if you refresh this page.")) {
                window.location.reload()            
               }
                   return false
            }            

        }

        FormAsset.find('button[type=button]').on('click',function(){
            resetform()
        })

 
    </script>
@endsection
