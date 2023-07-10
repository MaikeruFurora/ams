@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

   <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card p-0">
                <div class="card-body pb-1">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered st-table table-hover dt-responsive nowrap" data-url="{{ route('authorize.sub.category.list') }}">
                            <thead class="st-header-table">
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
           </div> 
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header st-header-table">
                    SUB-CATEGORY INFO
                </div>
                <div class="card-body">
                    @if (session()->has('msg'))
                        <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                        </div>
                    @endif
                    <form method="POST" id="DataForm" action="{{ route('authorize.sub.category.store') }}" autocomplete="off" >@csrf
                        <input type="hidden" class="form-control" name="id">
                        <div class="form-group">
                            <label for="">Type of Category</label>
                            <select name="category" id="" class="form-control">
                                <option value="">Select Type</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('username')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Sub Category Name</label>
                            <input type="text" class="needFormat form-control " required name="name" maxlength="50" autofocus>
                            @error('username')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        <button type="button" class="btn btn-warning btn-block">Cancel</button>
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
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        const DataForm = $("#DataForm")
        DataForm.find(".btn-warning").hide().on('click',function(){
            DataForm[0].reset()
            $(this).hide()
        })

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
                        data:'category'
                    },
                    { 
                        data:null,
                        render:function(data){
                            return Config.dropdown([
                                {
                                    text:'Edit',
                                    name:'edit',
                                    icon:'<i class="fas fa-edit mr-1"></i>',
                                    value:data.id
                                }
                            ])
                        }
                    },
                ]
        })

        $(document).on('click','button[name=edit]',function(){
            let data =tbl.row( $(this).closest('tr') ).data();
            console.log(data);
            DataForm.find('input[name=name]').val(data.name)
            DataForm.find('input[name=id]').val(data.id)
            DataForm.find('select[name=category]').val(data.category_id)
            DataForm.find(".btn-warning").show()
        })

    </script>
@endsection
