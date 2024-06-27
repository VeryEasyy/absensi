<div class="appBottomMenu">
    <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline" role="img" class="md hydrated"
            aria-label=" home outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    {{-- <a href="#" class="item">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated"
                aria-label="calendar outline"></ion-icon>
            <strong>Calendar</strong>
        </div>
    </a> --}}
    <a href="/absensi/izin" class="item {{ request()->is('') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Pengajuan Izin</strong>
        </div>
    </a>
    <a href="/absensi/masuk" class="item {{ request()->is('absensi/masuk') ? 'active' : '' }}">
        <div class="col">
             <ion-icon name="camera-outline"role="img" class="md hydrated" aria-label="add outline"></ion-icon>
             <strong>Absensi</strong>
        </div>
    </a>
    <a href="/profile" class="item {{ request()->is('profile') ? 'active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
    <a href="/logout" class="item ">
        <div class="col">
            <ion-icon name="log-out-outline"></ion-icon>
            <strong>Keluar</strong>
        </div>
    </a>
</div>