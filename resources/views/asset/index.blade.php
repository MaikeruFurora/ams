@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/searchBuilder.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/dataTables.dateTime.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Assets">
        <a href="{{ route('authorize.asset.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle mr-1"></i> Create New</a>
        <button class="btn btn-primary btn-sm" type="button" data-toggle="canvas" data-target="#bs-canvas-right" aria-expanded="false" aria-controls="bs-canvas-right">&#9776;</button>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card p-0">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table cellspacing="0" id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap adjust" 
                            data-url="{{ route('authorize.asset.list') }}" style="width: 100%">
                            <thead class=" st-header-table">
                                <tr class="tr-head">
                                    <td rowspan="2" width="5%"></td>
                                    <td rowspan="2" width="5%"></td>
                                    <td rowspan="2" width="5%">Action</td>
                                    <td rowspan="2" width="5%">Asset Code</td>
                                    <td class="border">Status</td>
                                    <td class="border">Category</td>
                                    <td class="border">Sub Category</td>
                                    <td class="border" rowspan="2">Item Name</td>
                                    <td rowspan="2">Serial Number</td>
                                    <td rowspan="2">Purchase Order</td>
                                    <td rowspan="2">Purchase Amount</td>
                                    <td rowspan="2">Actual Amount</td>
                                    <td rowspan="2">Date Purchase</td>
                                    <td rowspan="2">Date Recieve</td>
                                    <td rowspan="2">Description/Spec</td>
                                </tr>
                                <tr class="tr-head">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer p-1" style="background: #34708a">
                    <form  target="_blank" id="GenerateForm" method="POST" action="{{ route('authorize.asset.generate') }}">@csrf
                        <div class="col-3">
                            <input type="hidden" name="asset">
                        <div class="input-group input-group-sm">
                            <select class="custom-select custom-select-sm" name="generate" id="">
                                <option value="barcode">BarCode</option>
                                <option value="qrcode">QrCode</option>
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-primary" type="submit" id="button-addon2"><i class="fas fa-paper-plane"></i> Generate</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
           </div> 
        </div>
    </div> 
    <div id="bs-canvas-right" class="bs-canvas bs-canvas-anim bs-canvas-right position-fixed bg-light h-100">
        <header class="bs-canvas-header p-1 bg-primary overflow-auto">
            <button type="button" class="bs-canvas-close float-left close" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>
            <h4 class="d-inline-block text-light mb-0 float-right">BARCODE</h4>
        </header>
        <div class="bs-canvas-content px-3 py-5">
            ...
        </div>    
    </div>
@endsection
@section('moreJs')
   <!-- Required datatable js -->
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{  asset('plugins/datatables/jszip.min.js') }} "></script>
   <script src="{{  asset('plugins/datatables/pdfmake.min.js') }} "></script>
   <script src="{{  asset('plugins/datatables/vfs_fonts.js') }} "></script>
   <script src="{{  asset('plugins/datatables/buttons.html5.min.js') }} "></script>
   <script src="{{  asset('plugins/datatables/buttons.print.min.js') }} "></script>
   {{-- <script src="{{  asset('plugins/datatables/dataTables.fixedHeader.min.js') }} "></script> --}}
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.searchBuilder.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.dateTime.min.js') }}"></script>
    <script>

        const asset = []
        let cardFooter = $(".card-footer");
        cardFooter.hide()
        $(document).on('change','input[type="checkbox"]',function(){
            if($(this).is(":checked")){
                asset.push($(this).val());
                asset.find(val=>val==$(this).val())
            }else{
                let index = asset.indexOf($(this).val())
                asset.splice(index,1);
            }
            if (asset.length>0) {
                cardFooter.show()
            } else {
                cardFooter.hide()
            }
        })
       
        const tbl = Config.tableData.DataTable({
            ordering:false,
            ajax: Config.tableData.attr("data-url"), 
            // dom: 'Qlfrtip',
            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'excelHtml5',
            //         exportOptions: {
            //             columns: [ 1,2,3,4,5,6,7,8,9 ],
                       
            //         }
            //     },
            //     {
            //         extend: 'pdfHtml5',
            //         download: 'open',
            //         orientation: 'landscape',
            //         pageSize: 'LEGAL',
            //         exportOptions: {
            //             columns: [ 1,2,3,4,5,6,7,8,9 ],
                        
            //         }
            //     },
            // ],
            language: {
                processing: `
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>`,
            },
            initComplete: function () {
                this.api()
                    .columns([4,5,6])
                    .every(function () {
                        var column = this;
                        var select = $('<select class="custom-select custom-select-sm m-0" style="font-size:10px"><option value="">All</option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
            columns:[
                {
                    orderable:false,
                    searchable: false,
                    data:null,
                    render: function (data, type, row, meta) {
                        return `<span class="ml-4 text-left">${(meta.row + meta.settings._iDisplayStart + 1)}</span>`;
                    }
                },
                { 
                    orderable:false,
                    searchable: false,
                    data:null,
                    render:function(data){
                        return `<input type="checkbox" class="form-check" style="margin-right:0px" value="${data.id}">`
                    }
                },
                { 
                    data:null,
                    render:function(data){
                        return Config.dropdown([
                                {
                                    text:'View / Edit',
                                    name:'edit',
                                    icon:'<i class="fas fa-edit mr-1"></i>',
                                    url:'asset/edit/'+data.id,
                                    elementType:'a',
                                    value:data.id
                                },
                                {
                                    text:'Record',
                                    name:'record',
                                    icon:'<i class="fas fa-history"></i>',
                                    url:'asset/record/'+data.id,
                                    elementType:'a',
                                },
                            ])
                    }
                },
                { 
                    data:'asset_code'
                },
                { 
                    data:'asset_status'
                },
                { 
                    data:'category'
                },
                { 
                    data:'sub_category'
                },
                { 
                    data:'item_name'
                },
                { 
                    data:'serial_no'
                },
                { 
                    data:'purchase_order'
                },
                { 
                    data:'purchase_amount'
                },
                { 
                    data:'actual_amount'
                },
                { 
                    data:'date_purchase'
                },
                { 
                    data:'date_recieve'
                },
                { 
                    data:null,
                    render:function(data){
                        return`<div class="text-wrap text-justify">${data.description}</div>`
                    }
                },
              
            ]
        })

       const generateData = (val) =>{

            window.open(cardFooter.attr("data-url")+`/asset=${asset}?type=`+val+`/_token=`+Config.token);

       }
        
        $("#GenerateForm").on('click',function(){
            $("#GenerateForm").find('input[name=asset]').val(asset)
            tbl.ajax.reload()
            cardFooter.hide()
            asset.length=0
        })


    </script>
@endsection
