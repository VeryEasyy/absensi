<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Form Register</title>
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
            <header class="header">Form Registrasi</header>
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
                            window.location.href = '/';
                        }, 2000); 
                    </script>
                    @endif
                    @if (Session::get('error'))
                        <div class="alert alert-error" style="background-color: red">
                            {{ $messageerror }}
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = '/auth/register';
                            }, 2000); 
                        </script>
                    @endif
                </div>
            <form action="/auth/register" method="post" class="form">
                @csrf
                <input type="text" name="nuptk" placeholder="Masukan NUPTK" value="{{ old('nuptk') }}" required><br>
                @error('nuptk')
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

                <input type="text" name="jabatan" placeholder="Masukan Jabatan" value="{{ old('jabatan') }}" required><br>
                @error('jabatan')
                <div class="invalid-feedback">
                    {{  $message }}
                  </div>
                @enderror

                <input type="text" name="no_hp" placeholder="Masukan No HP" value="{{ old('no_hp') }}" required><br>
                @error('no_hp')
                <div class="invalid-feedback bg">
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
            </form>
            <div class="signup">
                <span class="daftar">Sudah punya akun?
                    <label for="check" class="label">Login</label>
                </span>
            </div>
        </div>
    </div>
</body>
</html>
