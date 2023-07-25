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
</style>
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="Asset Record">
        <button name="setAssetStatus" class="btn btn-sm btn-primary"><i class="fas fa-tools"></i> Set Asset Status </button>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left mr-1"></i> Back</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
           
            {{-- <section id="cd-timeline" class="cd-container"> --}}
                @forEach ($asset->record as $value)
                <div class="card m-1 card-body">
                    <h4 class="card-title font-14 mt-0">{{ $value->created_at->format('M d, Y') }}</h4>
                    <p class="card-text">{{ $value->remarks }}</p>
                    <p>{{  empty($value->user->name)?:'Accountable to: '.$value->user->name }}</p>
                    {{-- <p class="mb-0">{{ 'Control No. :'. $asset->accountability->control_no ??'' }}</p> --}}
                    <p class="card-text mb-0 pb-0">
                        <p class="text-muted mb-0">Status: <span class="badge badge-primary">{{ $value->asset_status->name }}</span></p>
                    </p>
                </div>
                @endforeach
            {{-- </section> <!-- cd-timeline --> --}}

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
           <div class="card">
            <div class="card-header text-white" style="background: #76b8db">
                <b>Details</b>
            </div>
            <div class="card-body p-1">
                <ul class="list-group">
                    <li class="list-group-item">Asset Code: <b>{{ $asset->asset_code }}</b></li>
                    <li class="list-group-item">Serial No: <b>{{ $asset->serial_no }}</b></li>
                    <li class="list-group-item">Product No: <b>{{ $asset->product_no }}</b></li>
                    <li class="list-group-item">Date Purchase: <b>{{ $asset->date_purchase }}</b></li>
                    <li class="list-group-item">Date Recieve: <b>{{ $asset->date_recieve }}</b></li>
                    <li class="list-group-item">Purchase Amount: <b>{{ $asset->purchase_amount }}</b></li>
                    <li class="list-group-item">Actual Amount: <b>{{ $asset->actual_amount }}</b></li>
                    <li class="list-group-item">Description: <br><b>{{ $asset->description }}</b></li>
                </ul>
            </div>
            <div class="card-footer p-0 px-5 text-center" style="background: #76b8db">
                <img width="100%" class="mt-1" height="40px"  src="data:image/png;base64,{{DNS1D::getBarcodePNG($asset->asset_code, 'C39')}}" alt="barcode" />
                <small><b>{{ $asset->asset_code }}</b></small>
            </div>
           </div>
        </div>
    </div> 
@include('modal.assetStatus',['assetStatus'=>$assetStatus])
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
        $("button[name=setAssetStatus]").on('click',function(){
            $("#modalstatusChange").modal("show")
        })
    </script>
@endsection
