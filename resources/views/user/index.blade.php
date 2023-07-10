@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <table id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap" 
                            data-url="{{ route('authorize.user.list') }}"
                            data-url-edit="{{ route("authorize.user.edit",[0]) }}">
                            <thead class="st-header-table">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>Contact No.</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
       
        const tbl = Config.tableData.DataTable({
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
                        data:'name'
                    },
                    { 
                        data:'job_title'
                    },
                    { 
                        data:'dep_name'
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
                            ])
                            // console.log(Config.tableData.attr("data-url-edit"));
                        }
                    },
                ]
        })


    </script>
@endsection
