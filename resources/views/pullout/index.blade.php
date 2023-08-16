@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .adjust tr td{
    padding: 3px !important;
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
                        <table id="datatable" class="adjust table table-bordered st-table dt-responsive nowrap" 
                            data-url="{{ route('authorize.pullout.list') }}"
                            data-url-recieve="{{ route('authorize.pullout.recieve') }}"
                            data-url-form="{{ route('authorize.pullout.form',['pullout'=>'sample']) }}"
                            >
                            <thead class="st-header-table">
                                <tr>
                                    <th></th>
                                    <th width="7%">Action</th>
                                    <th width="5%">Pullout No.</th>
                                    <th width="40%">Remarks</th>
                                    <th width="5%">Date Recieved</th>
                                    <th width="5%">Created at</th>
                                    <th>Items</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
           </div> 
        </div>
    </div> 
@include('modal.returnAsset')
@endsection
@section('moreJs')
   <!-- Required datatable js -->
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script>
        let returnURL = "{{ route('authorize.return',':pullout') }}"
        let tbl = Config.tableData.DataTable({
            ordering: false,
            serverSide: true,
            paging:true,
            ajax:Config.tableData.attr("data-url"),
            lengthMenu: [5, 10, 20, 50, 100],
            columns:[
                { 
                    visible:false,
                    data:'id'
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
                            {
                                text:'Pullout Form',
                                name:'pulloutForm',
                                icon:'<i class="fas fa-paste"></i>',
                                elementType:'button',
                                value: data.id, 
                            },
                            {
                                text:'Return Asset',
                                name:'returnAsset',
                                icon:'<i class="fas fa-undo"></i>',
                                elementType:'link',
                                url:returnURL.replace(':pullout',data.id),
                                disabled:(data.date_recieved=="")
                            },
                        ])
                    }
                },
                    { 
                        data:'pullout_no'
                    },
                    { 
                        data:'remarks',
                        render: function ( data, type, row ) {
                            return '<span style="white-space:normal">' + data + "</span>";
                        }
                    },
                    { 
                        data:'date_recieved'
                    },
                    { 
                        data:'created_at'
                    },
                    { 
                        data:null,
                        render: function ( data, type, row ) {
                            let hold=`<table class="table table-sm table-bordered  m-0">
                                <thead class="st-header-table">
                                    <tr>
                                        <th>#</th>    
                                        <th>Asset Code</th>    
                                        <th>Item Name</th>    
                                    </tr>
                                </thead>`;
                            data.pullout_detail.forEach((element,i) => {
                                hold+=`
                                    <tr class="adjust">
                                        <td>${++i}</td>
                                        <td>${element.asset.asset_code}</td>
                                        <td>${element.asset.item_name}</td>
                                    </tr>
                                `
                            });
                            hold+='</table>'
                            return hold;
                        }
                    },
                ]
        })

        $(document).on('click',"button[name=viewMyAsset]",function(){
              $("#modalViewMyAsset").modal("show")
              viewMyAsset($(this).val())
        })

        $(document).on('click',"button[name=pulloutForm]",function(){
            Config.loadToPrint(Config.tableData.attr('data-url-form').split('sample')[0]+this.value)
        })

        $(document).on('click',"button[name=returnAsset]",function(){
            let  _hold=''
            let data =tbl.row( $(this).closest('tr') ).data();
            data.pullout_detail.forEach((element,i) => {
                console.log(element);
                _hold+=`<tr>
                            <td>
                                ${++i}<input name="asset[]" value="${element.asset_id}" type="hidden">
                            </td>
                            <td>${element.asset.asset_code}</td>
                            <td>${element.asset.item_name}</td>
                            <td><select name="status[]" class="custom-select custom-select-sm"></select></td>
                            <td><input name="remarks[]" class="form-control form-control-sm" maxlength="100"></td>
                        </tr>`
            });
            $("#returnAssetTbl").find('tbody').html(_hold)
            $("#returnAssetModal").modal("show")
        })

        $(document).on('click',"button[name=recieve]",function(e){
            e.preventDefault()
            let data =tbl.row( $(this).closest('tr') ).data();
            $.ajax({
                url:Config.tableData.attr("data-url-recieve"), 
                type:'POST',
                data:{
                    id:data.id,
                    _token:Config.token
                }
            }).done(function(data){
                tbl.ajax.reload()
                alertify.alert("Success!")
            }).fail(function(a,b,c){
                console.log(a,b,c);
            })
        })

        
    </script>
@endsection
