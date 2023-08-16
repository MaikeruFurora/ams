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
     <x-page-title title="Return Asset">
        <a href="{{ route('authorize.pullout') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left mr-1"></i>Back</a>
    </x-page-title>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            {{-- <div class="card-header p-2 card-sky">
                <span>PULLOUT NO: <b>{{ $pullout->pullout_no }}</b></span>
            </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>PULLOUT NO: <b>{{ $pullout->pullout_no }}</b></p>
                        <form action="{{ route('authorize.return.store') }}" method="POST">@csrf
                            <div class="accordion" id="accordionExample">
                                <div class="card mb-0 border-bottom">
                                @forelse ($pullout->pullout_detail->whereNull('return_date') as $key=> $item)
                                  <div class="card-header border p-0 pb-1" id="headingOne">
                                    <h2 class="mb-0">
                                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne-{{ $key }}" aria-expanded="true" aria-controls="collapseOne-{{ $key }}">
                                       <div class="row justify-content-between">
                                            <div class="col-4"><i class="fas fa-caret-down mr-2"></i> {{ $item->asset->asset_code }}</div>
                                            <div class="col-1"><i class="fas fa-question-circle float-right"
                                                data-html="true"
                                                data-toggle="popover"
                                                type="button"
                                                data-content='<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam esse autem sint dolorem necessitatibus exercitationem velit libero rerum reiciendis quae, impedit in magni similique. Omnis explicabo eius possimus iusto sequ</p>'></i></div>
                                       </div>
                                      </button>
                                    </h2>
                                  </div>
                              
                                  <div id="collapseOne-{{ $key }}" class="collapse {{ $key==0?"show":'' }}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body border border-bottom">
                                        <div class="row">
                                            <div class="col">
                                                <dl class="row">
                                                    <dt class="col-sm-3">Asset Code</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->asset_code }}</dd>
                                                  
                                                    <dt class="col-sm-3">Name</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->item_name }}</dd>
                                                  
                                                    <dt class="col-sm-3">Description/Spec</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->description }}</dd>
                                                  
                                                    <dt class="col-sm-3 text-truncate">Purchase Amount</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->purchase_amount }}</dd>
                                                </dl>
                                            </div>
                                            <div class="col">
                                                <dl class="row">
                                                    <dt class="col-sm-3">Serial No</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->serial_no }}</dd>
                                                  
                                                    <dt class="col-sm-3">Product No</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->product_no }}</dd>
                                                  
                                                    <dt class="col-sm-3">Brand</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->brand }}</dd>
                                                    
                                                    <dt class="col-sm-3">Purchase Order</dt>
                                                    <dd class="col-sm-9">{{ $item->asset->purchase_order }}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <input type="hidden" name="pullout_detail[]" value="{{ $item->id }}">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                               <p class="my-2">Return Remarks</p>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-4 col-form-label text-right">Item Status</label>
                                                    <div class="col-sm-8">
                                                      <select name="return_status[]" id="" class="custom-select custom-select-sm">
                                                        <option value="" selected disabled></option>
                                                        @foreach ($asset_status as $status)
                                                            <option value="{{ $status->name }}">{{ $status->name }}</option>
                                                        @endforeach
                                                      </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <textarea name="return_remarks[]" id="" class="form-control" cols="30" rows="3" required></textarea>
                                    </div>
                                  </div>
                                  @empty
                                    <p class="p-5 text-center"><em>No Item Available</em></p>
                                  @endforelse
                                </div>
                                <button type="submit" {{ (count($pullout->pullout_detail->whereNull('return_date'))>0)?:'disabled' }} class="btn btn-primary btn-sm float-right mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
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
  
@endsection
