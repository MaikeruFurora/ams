@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/searchBuilder.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/dataTables.dateTime.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .tr-head td{
    padding: 3px !important;
    margin: 0 !important;
    text-align: center;
    }

    .adjust tr td{
    padding: 5px !important;
    margin: 0 !important;
    }
    
</style>
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Assets">
        <a href="{{ route('authorize.asset.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle mr-1"></i> Create New</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card p-0">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table cellspacing="0" id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap adjust" 
                            data-url="{{ route('authorize.asset.list') }}" style="width: 100%">
                            <thead class=" st-header-table text-center">
                                <tr class="tr-head">
                                    <td rowspan="2" width="3%"></td>
                                    <td rowspan="2" width="5%">Action</td>
                                    <td rowspan="2">Asset Code</td>
                                    <td class="border">Category</td>
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
                            {{-- <tfoot class="st-header-table adjust">
                                <tr>
                                    <th>Asset Code</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Item Nname</th>
                                    <th>Serial Number</th>
                                    <th>Purchase Order</th>
                                    <th>Purchase Amount</th>
                                    <th>Actual Amount</th>
                                    <th>Date Purchase</th>
                                    <th>Date Rcieve</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> --}}
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
                    .columns([3,4,5])
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
                    render:function(data){
                        return `<input type="checkbox" class="form-check ml-4" style="margin-right:0px" value="${data.id}">`
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
            console.log($(this).val());
        })


    </script>
@endsection
