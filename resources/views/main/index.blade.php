@extends('../layout/app')
@section('moreCss')
    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

   <div class="card">
        <div class="card-body">
          
        </div>
   </div> 
   
    <div class="modal fade" id="propMessage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="propMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <p class="modal-title" id="propMessageLabel"></p>
                </div>
                <div class="modal-body text-center">
                   <span id="promptText"></span>
                </div>
                <div class="modal-footer p-1">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-sm btn-primary pl-3 pr-3">Post</button>
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
@endsection
