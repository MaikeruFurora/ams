@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Alertify css -->
<link href="{{ asset('plugins/alertify/css/alertify.css') }}" rel="stylesheet" type="text/css">
<style>
   .adjust tr td{
        padding: 3px !important;
        margin: 0 !important;
    }
    .table.dataTable td {
        padding: 5px
    }

    .red {
        background-color: red !important;
    }
</style>
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Assign Accountability">
        <a href="{{ route('authorize.user') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        <button class="btn btn-secondary btn-sm mr-2" name="pullout" disabled><i class="fas fa-sync"></i> Pullout</button>
    </x-page-title>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link " id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Assign</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Accountability</button>
                        </li>
                        <li class="nav-item p-1 float-right" role="presentation">
                            <form id="accountabilityForm" action="{{ route('authorize.accountability.print',['controlNo'=>'Sample']) }}">
                                <div class="input-group input-group-sm">
                                    <select name="control_no" id="" class="custom-select custom-select-sm">
                                        <option value=""></option>
                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" type="button" id="button-addon2">Print</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                      </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row mt-3">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <form id="FormAssign" autocomplete="off">
                                        <div class="card">
                                            <div class="card-header p-2 text-white" style="background: #76b8db">
                                               <b> <i class="fas fa-tags"></i> Asset Assigned</b>
                                            </div>
                                            <div class="card-body p-1">
                                               <div class="input-group input-group-sm mb-1">
                                                   <div class="input-group-prepend">
                                                     <span class="input-group-text" id="basic-addon1">CONTROL NO.</span>
                                                   </div>
                                                   <input type="text" class="form-control" name="control_no" placeholder="Control No." required>
                                                   <input type="hidden" class="form-control" name="user" value="{{ $user->id }}">
                                                </div>
                                                <div class="input-group input-group-sm mb-1">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text" id="basic-addon1">ISSUED AT</span>
                                                    </div>
                                                    <input type="date" class="form-control datepicker" name="issued_at" placeholder="Date Issued" required>
                                                  </div>
                                               <table class="adjust text-center table table-hovered table-bordered pb-0 mt-0 mb-0" id="myCheckoutTbl">
                                                   <thead>
                                                       <tr>
                                                           <th>Asset Code</th>
                                                           <th>Serial No.</th>
                                                           <th width="4%">Remove</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                       <tr><td colspan="3" class="text-center">No data here</td></tr>
                                                   </tbody>
                                               </table>
                                            </div>
                                            <div class="card-footer p-1 text-white float-left" style="background: #76b8db">
                                               <div class="float-right">
                                                   <button type="submit" class="btn btn-sm btn-primary py-1 checkout" disabled class="fas fa-paper-plane"></i> CheckOUt</button>
                                               </div>
                                           </div>
                                       </div>
                                    </form>
                                 </div>
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                   <div class="card">
                                        <div class="card-header p-2 text-white" style="background: #76b8db">
                                           <b> <i class="fas fa-user-circle"></i> ( {{ $user->name }} )</b>
                                        </div>
                                        <div class="card-body pb-2 px-0">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-sm table-striped table-bordered table-hover dt-responsive nowrap"
                                                    data-url="{{ route('authorize.asset.list') }}"
                                                    data-url-store="{{ route('authorize.accountability.store') }}" style="width: 100%">
                                                <thead class="adjust st-header-table">
                                                    <tr>
                                                        <th width="1%"></th>
                                                        <th class="text-center" width="1%">Action</th>
                                                        <th width="10%">Asset Code</th>
                                                        <th width="10%">Serial Number</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                {{-- <tfoot class="adjust">
                                                    <tr>
                                                        <td colspan="4" >
                                                            <input type="text" class="form-control form-control-sm" placeholder="Search">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary btn-block"><i class="fas fa-plus-circle"></i> Attach Asset</button>
                                                        </td>
                                                    </tr>
                                                </tfoot> --}}
                                            </table>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="font-size: 13px">
                            <div class="table-responsive mt-3">
                                <table id="assignedAccountTable" class="table table-bordered table-sm"
                                    data-url="{{ route("authorize.user.assign.list") }}"
                                    data-status-url={{ route('authorize.status.list') }} style="width: 100%">
                                    <thead class="text-center text-white st-header-table">
                                        <tr>
                                            <th width="1%"></th>
                                            <th></th>
                                            <th width="10%">Control No.</th>
                                            <th width="10%">Asset-Code</th>
                                            <th width="10%">Serial No.</th>
                                            <th>Item name</th>
                                            <th>Brand/Model</th>
                                            <th width="10%">Date Issued</th>
                                            <th width="">Status</th>
                                            {{-- <th width="7%">Action</th> --}}
                                        </tr>
                                    </thead>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--card-->
        </div>
        @include('modal.pullout',['assetStatus'=>$assetStatus])
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
   <script>
        const assetArr              = []
        const asset                 = []
        const controlNoList         = []
        const assetToPull           = []
        const myCheckoutTbl         = $("#myCheckoutTbl")
        let   FormAssign            = $("#FormAssign")
        let   assignedAccountTable  = $("#assignedAccountTable")
        let   cardFooter            = $(".foot")
        let   accountabilityForm    = $("#accountabilityForm")
        let   selectControlNo       = $("select[name=control_no]")
        let   _hold                 = `<option>Select Control No.</option>`
        let   FormPullout           = $("#FormPullout")
        // cardFooter.hide()
        
        let tbl = Config.tableData.DataTable({
            ordering: false,
            ajax: {
                url:Config.tableData.attr("data-url"),
                type:'GET',
                data:{
                    user:FormAssign.find('input[name=user]').val()
                }
            },
            language: {
                processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`,
            },
            columnDefs: [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '5px')
                }
            }],
            columns:[
                { 
                    // visible:false,
                    data:'id'
                },
                { 
                    data:null,
                    render:function(data){
                        return `<button class="attachBtn btn btn-sm btn-primary px-1"><i class="fas fa-arrow-circle-left"></i>&nbsp;Attach</button>`
                    }
                },
                { 
                    data:'asset_code'
                },
                { 
                    data:'serial_no'
                },
                { 
                    data:'description'
                },
              
            ]
        })

        $(document).on('click','.attachBtn',function(e){
            e.preventDefault()
            
            let data = tbl.row($(this).closest('tr')).data();

                if (assetArr.some(val=>val.id==data.id)) {
                    alertify.alert("already attached")
                }else{
                    assetArr.push({
                        'id':data.id,
                        'asset_code':data.asset_code,
                        'serial_no':data.serial_no
                    })
                }
            myCheckout()
        })

        const myCheckout = () =>{
            let hold=''
            assetArr.forEach(element => {
                hold+=`
                    <tr>
                        <td>${element.asset_code}</td>
                        <td>${element.serial_no}</td>
                        <td><button value="${element.id}" class="btn btn-sm text-danger remove"><i class="fas fa-times"></i></button></td>
                    </tr>
                `
            });
            
            if (assetArr.length==0) {
                hold=`<tr><td colspan="3" class="text-center">No data here</td></tr>`
            }

            myCheckoutTbl.find('tbody').html(hold)
            $(".checkout").prop("disabled",assetArr.length==0)
        }

        $(document).on('click','.remove',function(e){
            e.preventDefault()
            assetArr.splice(assetArr.findIndex(val=>val.id==$(this).val()),1)
            myCheckout()
        })

        FormAssign.on('submit',function(e){
            e.preventDefault()
            console.log(assetArr.map(val=>val.id));
            const asset = assetArr.map(val=>val.id)
            let form = FormAssign[0]
            let formData = new FormData(form);
            formData.append('qty',FormAssign.find('input[name=control_no]').val())
            formData.append('user',FormAssign.find('input[name=user]').val())
            formData.append('_token',Config.token)
            formData.append('asset',asset)
            $.ajax({
                url:Config.tableData.attr("data-url-store"),
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(data){
                assignTbl.ajax.reload()
                assetArr.length=0
                FormAssign[0].reset()
                myCheckout()
                tbl.ajax.reload()
            }).fail(function (jqxHR, textStatus, errorThrown) {
                console.log(errorThrown);
            })
        })

        
        // $(document).on('change','input[type="checkbox"]',function(){
        //     if($(this).is(":checked")){
        //         asset.push($(this).val());
        //         asset.find(val=>val==$(this).val())
        //     }else{
        //         let index = asset.indexOf($(this).val())
        //         asset.splice(index,1);
        //     }
        //     accountabilityForm.find("button[name=pullout]").prop('disabled',!(asset.length>0))
            
        // })

        $('button[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
            // var target = $(e.target).attr("href"); // activated tab
            // alert (target);
            $($.fn.dataTable.tables( true ) ).css('width', '100%');
            $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
            console.log('click');
        } ); 



        /// ACCOUNTABLE
    
        accountabilityForm.on('submit',function(e){
            e.preventDefault()
            let url = $(this).attr("action").split("/Sample")[0]+'/'+selectControlNo.val()
            console.log(url);
            Config.loadToPrint(url)
        })

        $(document).on('change','input[type="checkbox"]',function(){
            if($(this).is(":checked")){
                let data =assignTbl.row( $(this).closest('tr') ).data();
                assetToPull.push(data)
                assetToPull.find(val=>val.asset_code==$(this).val())
            }else{
                let index = assetToPull.indexOf($(this).val())
                assetToPull.splice(index,1);
            }

            $("button[name=pullout]").attr("disabled",!assetToPull.length>0)

        })


        
        let assignTbl  = assignedAccountTable.DataTable({
            ordering: false,
            // bDestroy:true,
            ajax: {
                url:assignedAccountTable.attr('data-url'),
                type:'GET',
                data:{
                    user:FormAssign.find('input[name=user]').val()
                }
            },
            language: {
                processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`,
            },
            columnDefs: [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '5px')
                }
            }],
            createdRow:function( row, data, dataIndex ) {
                if (data.pullout_detail.length>0) {
                    if (data.pullout_detail[0].return_date==null) {
                        $(row).css('background','#badfd7');
                    }
                }
            },
            initComplete: function() {
                var dd = assignTbl
                    .columns(2)
                    .data()
                    .eq(0)      // Reduce the 2D array into a 1D array of data
                    .sort()       // Sort data alphabetically
                    .unique()     // Reduce to unique values
                    .toArray();

                    dd.forEach(val=>{
                        _hold+=`<option value="${val}">${val}</option>`
                    })

                    selectControlNo.html(_hold)
            },
            columns:[
                { 
                    orderable:false,
                    searchable: false,
                    data:null,
                    render:function(data){
                        return `<input type="checkbox" class="form-check" value="${data.id}" ${
                            (data.pullout_detail.length>0)
                                ?((data.pullout_detail[0].return_date==null)?'disabled':''
                            ):''}>`
                    }
                },
                { 
                    orderable:false,
                    searchable: false,
                    visible:false,
                    data:'user_id'
                },
                { 
                    data:'control_no'
                },
                { 
                    data:'asset_code'
                },
                { 
                    data:'serial_no'
                },
                { 
                    data:'item_name'
                },
                { 
                    data:'brand'
                },
                { 
                    data:'issued_at'
                },
                { 
                    data:'status'
                },
                // {
                //     data:null,
                //     render:function(data){
                //         // console.log(data.status_code=='PULLOUT');
                //         return Config.dropdown([
                //                 {
                //                     text:'Pullout',
                //                     name:'pullout',
                //                     icon:'<i class="fas fa-sync-alt"></i>',
                //                     elementType:'button',
                //                     value:data.asset_id,
                //                     disabled:data.status_code=='PULLOUT'
                //                 },
                //             ])
                //     }
                // }
            ]
        })


        $('button[name=pullout]').on('click','',function(){
            console.log(assetToPull);
            let  _hold=''
            assetToPull.forEach((element,i) => {
                _hold+=`<tr>
                            <td>
                                ${++i}<input name="asset[]" value="${element.asset_id}" type="hidden">
                            </td>
                            <td>${element.asset_code}</td>
                            <td>${element.item_name}</td>
                            <td>${element.status}</td>
                        </tr>`
            });
            $("#pulloutAssetTbl").find('tbody').html(_hold)
            $("#modalstatusChange").modal("show")
        })

        FormPullout.on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:FormPullout.attr('action'),
                type:'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            }).done(function(data){
                console.log(data);
                FormPullout[0].reset()
                assignTbl.ajax.reload()
                assetToPull.length=0
                Config.loadToPrint()
                $('button[name=pullout]').attr('disabled',true)
                $("#modalstatusChange").modal("hide")
                Config.loadToPrint(FormPullout.attr('data-url').split('sample')[0]+data)
            }).fail(function(a,b,c){
                console.log(a,b,c);
            })
        })

   </script>
@endsection
