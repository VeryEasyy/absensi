<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Login </title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">
                <div class="body">
                    <div class="card-body">
                        <form action="/proseslogin" method="POST"  style="margin-top: 90px ">
                            @csrf
                            <div class="login-form mt-3">
                                <div class="section">
                                    <img src="{{ asset('assets/img/logo sd.jpg') }}" alt="image" class="form-image">
                                </div>
                                <div class="section mt-1">
                                    <h4>Silahkan Login</h4>
                                </div>
                                <div class="section mt-1 mb-5">
                                    @php
                                        $messageWarning = Session::get('danger');
                                    @endphp
                                    @if (Session::get('danger'))
                                        <div class="alert alert-outline-danger">
                                            {{ $messageWarning }}
                                        </div>                        
                                    @endif
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <input type="text" name="nuptk" class="form-control @error('nuptk') is-invalid @enderror" id="nuptk" placeholder="NUPTK">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                                @error('nuptk')
                                <div class="invalid-feedback text-warning">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
        
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                    <i class="clear-input">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </i>
                                </div>
                                @error('password')
                                <div class="invalid-feedback text-warning">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
        
                            <div class="form-links mt-2  d-flex justify-content-end">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>

                            <div class="form-button mt-3">
                                <button type="submit" class="btn btn-success btn-block btn-lg">Log in</button>
                            </div>

                            <div class="text-center mt-3">
                                <span>Don't have an account? <a href="/auth/register" class="text-primary">Register</a></span>
                            </div>
                        </div>
        
                        </form>
                    </div>
                </div>
              
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>


</body>

</html>