@if ($combinedData->isEmpty())
    <div class="alert alert-warning" style="background-color: rgba(255, 204, 0, 0.904)">
        <b style="color: black">Belum ada Data Izin / Sakit</b>
    </div>
@endif

@foreach ($combinedData as $d)
    @if ($d->status_approved == 0)
        <span>1</span>
    @else
        
    @endif
    <ul class="listview image-listview">
        <li>
            <div class="item">
                <div class="in">
                    <div>
                        @if(isset($d->tgl_izin))
                        <b>{{ date("d-m-Y",strtotime($d->tgl_izin)) }}
                            ({{ $d->status == "s" ? "Sakit" : "Izin" }})
                        </b><br>
                    @elseif(isset($d->tgl_mulai))
                        <b>{{ date("d-m-Y",strtotime($d->tgl_mulai)) }} - {{ date("d-m-Y",strtotime($d->tgl_mulai)) }}
                            ({{ $d->tipe_dinas }})
                        </b><br>
                        <i>{{ date("H:i:s",strtotime($d->waktu_mulai)) }} - {{ date("H:i:s",strtotime($d->waktu_selesai)) }} 
                        </i><br>
                    @endif
                        <small class="text-muted">{{ $d->keterangan }}</small>
                    </div>
                    @if($d->status_approved == 0)
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif($d->status_approved  == 1)
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($d->status_approved  == 2)
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </div>
            </div>
        </li>
    </ul>
@endforeach