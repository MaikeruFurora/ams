@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .adjust tr td{
   padding: 5px !important;
   margin: 0 !important;
 }
 </style>
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Pullout">
        <a href="{{ route('authorize.user.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle mr-1"></i> Back</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card p-0">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table id="datatable" class="adjust table table-bordered st-table table-hover dt-responsive nowrap" 
                            data-url="{{ route('authorize.pullout.list') }}"
                            data-url-recieve="{{ route('authorize.pullout.recieve') }}"
                            >
                            <thead class="st-header-table">
                                <tr>
                                    <th></th>
                                    <th width="5%">Pullout No.</th>
                                    <th width="5%">Asset Code</th>
                                    <th width="5%">Item Name</th>
                                    <th width="5%">Date Recieved</th>
                                    <th width="5%">Date Return</th>
                                    <th>Remarks</th>
                                    <th width="7%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
           </div> 
        </div>
    </div> 
{{-- @include('modal.viewMyAsset') --}}
@endsection
@section('moreJs')
   <!-- Required datatable js -->
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        const tbl = Config.tableData.DataTable({
            ordering: false,
            "serverSide": true,
            paging:true,
            "ajax": {
                url: Config.tableData.attr("data-url"), 
                method: "get"
            },
            // order: [[0, 'desc']],
            columns:[
                    { 
                        visible:false,
                        data:'id'
                    },
                    { 
                        data:'pullout_no'
                    },
                    { 
                        data:'asset_code'
                    },
                    { 
                        data:'item_name'
                    },
                    { 
                        data:'date_recieved'
                    },
                    { 
                        data:'date_return'
                    },
                    { 
                        data:'remarks',
                        render: function ( data, type, row ) {
                            return '<span style="white-space:normal">' + data + "</span>";
                        }
                    },
                    { 
                        data:null,
                        render:function(data){
                            return Config.dropdown([
                                {
                                    text:'Recieve',
                                    name:'recieve',
                                    icon:'<i class="fas fa-reply"></i>',
                                    elementType:'button',
                                    value: data.id, 
                                    disabled:(!data.date_recieved=="")
                                },
                            ])
                        }
                    },
                ]
        })

        $(document).on('click',"button[name=viewMyAsset]",function(){
              $("#modalViewMyAsset").modal("show")
              viewMyAsset($(this).val())
        })

        $(document).on('click',"button[name=recieve]",function(e){
            e.preventDefault()
            let data =tbl.row( $(this).closest('tr') ).data();
            $.ajax({
                url:Config.tableData.attr("data-url-recieve"), 
                type:'GET',
                data:{
                    id:data.id
                }
            }).done(function(data){
                console.log(data);
                tbl.ajax.reload()
                $("#modalstatusChange").modal("hide")
            }).fail(function(a,b,c){
                console.log(a,b,c);
            })
        })

        
    </script>
@endsection
