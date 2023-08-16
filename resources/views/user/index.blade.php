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
     <x-page-title title="Employee">
        <a href="{{ route('authorize.user.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle mr-1"></i> Create New</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card p-0">
                <div class="card-body pb-2">
                    <div class="table-responsive">
                        <table id="datatable" class="adjust table table-bordered st-table table-hover dt-responsive nowrap" 
                            data-url="{{ route('authorize.user.list') }}"
                            data-url-edit="{{ route("authorize.user.edit",[0]) }}"
                            data-url-assign="{{ route("authorize.user.assign",[0]) }}"
                            >
                            <thead class=" st-header-table text-center">
                                <tr class="tr-head">
                                    <th rowspan="2"></th>
                                    <th rowspan="2">Name</th>
                                    <th class="border">Title</th>
                                    <th class="border">Department</th>
                                    <th class="border" rowspan="2">Contact No.</th>
                                    <th rowspan="2">Username</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2" width="5%">Action</th>
                                </tr>
                                <tr class="tr-head">
                                    <td></td>
                                    <td></td>
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
        let   assignedAccountTable  = $("#assignedAccountTable")
        const tbl = Config.tableData.DataTable({
            ordering:false,
            ajax: Config.tableData.attr("data-url"),
            // order: [[0, 'desc']],
            initComplete: function () {
                this.api()
                    .columns([2,3])
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
                                if (d!=null) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                }
                            });
                    });
            },
            columns:[
                    { 
                        visible:false,
                        data:'id'
                    },
                    { 
                        data:'name'
                    },
                    { 
                        data:'job_title'
                    },
                    { 
                        data:'department'
                    },
                    { 
                        data:'contact_no'
                    },
                    { 
                        data:'username'
                    },
                   
                    { 
                        data:null,
                        render:function(data){
                            return `<span class="text-center badge badge-success" style="font-size:11px">Active</span>`
                        }
                    },
                    { 
                        data:null,
                        render:function(data){
                            return Config.dropdown([
                                {
                                    text:'Edit',
                                    icon:'<i class="fas fa-edit mr-1"></i>',
                                    elementType:'link',
                                    url: Config.tableData.attr("data-url-edit").split('/0')[0]+"/"+data.id, 
                                },
                                {
                                    text:'Accountability',
                                    icon:'<i class="fas fa-tags"></i>',
                                    elementType:'link',
                                    url: Config.tableData.attr("data-url-assign").split('/0')[0]+"/"+data.id,
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


        const viewMyAsset = (id) =>{
           
        }

        
    </script>
@endsection
