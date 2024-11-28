@extends('layouts.absensi')

@section('content')
<div class="container">
    <h2>Lupa Password</h2>
    <form action="{{ route('password.reset') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nuptk">NUPTK</label>
            <input type="text" name="nuptk" id="nuptk" class="form-control" required>
            @error('nuptk')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
