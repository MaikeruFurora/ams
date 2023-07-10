@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <table id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap" 
                            data-url="{{ route('authorize.user.list') }}">
                            <thead class="st-header-table">
                                <tr>
                                    <th></th>
                                    <th>Asset-Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>UOM</th>
                                    <th>Depricated</th>
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
       
        const tbl = Config.tableData.DataTable()


    </script>
@endsection
