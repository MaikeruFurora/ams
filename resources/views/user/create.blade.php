@extends('../layout/app')
@section('moreCss')
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
     <!-- Page-Title -->
     <x-page-title title="create new">
        <a href="{{ route('authorize.user') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
    </x-page-title>
    <div class="card p-2">
        <div class="card-body pb-2">
            <form autocomplete="off" method="POST" action="{{ route('authorize.user.store') }}">@csrf
                <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                <div class="row">
                    <div class="col-6">
                        @if (session()->has('msg'))
                            <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="Full name" value="{{ $user->name ??old('name') }}">
                             @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" id="" placeholder="Email" value="{{ $user->email ?? old('email')  }}">
                                 @error('email')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="">Contact No.</label>
                                <input type="text" name="contact_no" class="form-control" id="" placeholder="Contact No." value="{{ $user->contact_no ?? old('contact_no') }}">
                                 @error('contact_no')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" class="form-control" id="" placeholder="Username" value="{{ $user->username ?? old('username') }}">
                            @error('username')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Job Title</label>
                                <input type="text" name="job_title" class="form-control" id="" placeholder="Job Title" value="{{ $user->job_title ?? old('job_title') }}">
                                 @error('job_title')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="">Department</label>
                                <select name="department" id="" class="form-control">
                                    <option value="">Select Deparment</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}" @selected($item->id==($user->department_id ?? old('department')) )>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                 @error('department')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                    </div>
                    <div class="col-6 text-center">
                        <img src="{{ asset('assets/images/people.svg') }}" class="my-4" alt="" width="60%">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore fuga in deserunt reprehenderit, commodi adipisci distinctio? Accusamus odio quas consequuntur commodi error sequi illo possimus nesciunt, quam nam asperiores esse!</p>
                    </div>
                </div>
              </form>
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
