<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>AMS | AIM Inc</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    </head>


    <body>

       @include('layout.preloader')

        <!-- Begin page -->

        <div class="account-pages">
            
            <div class="container">
                <div class="row align-items-center">
                    {{-- <div class="col-lg-6">
                        <div>
                            <div >
                                <a href="index.html" class="logo logo-admin">
                                    <img src="{{ asset('assets/images/logo.pngs') }}" height="60" alt="logo">
                                </a>
                            </div>
                            <h5 class="font-14 text-muted">
                            <span class="typed4">Arvin International Marketing Inc.</span></h5>
                            <p class="text-muted ">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, explicabo est commodi autem veniam deserunt molestias nam, facere mollitia corporis, nulla sequi voluptate voluptas ad reiciendis! Aliquid perspiciatis maiores voluptas?
                            </p>

                            <h5 class="font-14 text-muted mb-4">Sign in with your account :</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Enter your personal account using your username and password.</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>If you continue to receive an error, please contact IT for assistance. </p>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-4 offset-lg-4">
                        @if (session()->has('msg'))
                            <div class="alert alert-{{ session()->get('action') ?? 'success' }}" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> {{ session()->get('msg') }}
                            </div>
                        @endif
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="p-2">
                                    <h6 class="text-muted float-right mt-4">Sign In</h6>
                                    <div>
                                        <a href="index.html" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}" height="50" alt="logo"></a>
                                    </div>
                                </div>
        
                                <div class="p-2">
                                    <form class="form-horizontal m-t-20" action="{{ route('auth.login.post') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="text" placeholder="Email | Username" name="username" autocomplete="off" autofocus value="itdept">
                                                @error('username')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input class="form-control" type="password" placeholder="Password" name="password" value="password">
                                                @error('password')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember_token">
                                                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>



        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script>
             var typed4 = new Typed('.typed4', {
                strings: ['Arvin International Marketing Inc', 'Moving ahead to serve you better'],
                typeSpeed: 40,
                backSpeed: 0,
                fadeOut: true,
                loop: true
            });
    
        </script>

    </body>
</html>