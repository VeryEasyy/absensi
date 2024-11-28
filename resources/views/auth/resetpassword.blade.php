@extends('layouts.absensi')

@section('content')
<div class="container">
    <h2>Reset Password</h2>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Atur Ulang Password</button>
    </form>
    <div class="row">
        <div class="col" style="color: black; text-align: center">
            @php
                $messagesucces = Session::get('success');
                $messageerror = Session::get('error');
                $messagestatus = Session::get('warning');
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
                        window.location.href = '/forgot-password';
                    }, 2000); 
                </script>
            @endif
            @if (Session::get('warning'))
             <div class="alert alert-info">
                 {{ $messagestatus }}
             </div>
            @endif
        </div>
</div>
@endsection
