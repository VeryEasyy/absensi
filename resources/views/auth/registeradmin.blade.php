<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Form Register Admin</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>
<body>
    <div class="container">
        <div class="register">
            <header class="header">Form Registrasi Admin</header>
            <div class="row">
                <div class="col" style="color: black; text-align: center">
                    @php
                        $messagesucces = Session::get('success');
                        $messageerror = Session::get('error');
                    @endphp
                     @if (Session::get('success'))
                     <div class="alert alert-success" style="background-color: lightgreen">
                         {{ $messagesucces }}
                     </div>
                     <script>
                        setTimeout(function() {
                            window.location.href = '/admin';
                        }, 2000); 
                    </script>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-error" style="background-color: red">
                            {{ $messageerror }}
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = '/admin/auth/registeradmin';
                            }, 2000); 
                        </script>
                    @endif
                </div>
            <form action="/admin/auth/registeradmin" method="post" class="form" >
                @csrf
                <input type="email" name="email" placeholder="Masukan Email" value="{{ old('email') }}"><br>
                @error('email')
                   <div class="invalid-feedback">
                     {{  $message }}
                   </div>
                @enderror

                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Anda" required><br>
                @error('nama')
                <div class="invalid-feedback">
                    {{  $message }}
                  </div>
                @enderror

                <input type="password" name="password" placeholder="Masukan password" required><br>
                @error('password')
                <div class="invalid-feedback">
                    {{  $message }}
                </div>
                @enderror

                <input type="password" name="password_confirmation" placeholder="Masukan ulang password"><br>

                <input type="submit" name="daftar" id="daftar" class="button" value="Daftar">

                <div class="signup">
                    <span class="daftar">Sudah punya akun?
                        <a href="/admin">
                            <label for="check" class="label">Login</label>  
                        </a>
                        
                    </span>
                </div>
            </form>
           
        </div>
    </div>
</body>
</html>
