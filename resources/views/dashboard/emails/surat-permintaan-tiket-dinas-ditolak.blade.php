@component('mail::panel')

# Hai 

Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas Anda ditolak.

Details:
- Nama Pemohon      : {{ $suratPermintaanTiketDinas['nama_pemohon'] }}
- Unit              : {{ $suratPermintaanTiketDinas['unit'] }}
Keberangkatan:
- Rute Asal         : {{ $suratPermintaanTiketDinas['rute_asal_berangkat'] }}
- Rute Tujuan       : {{ $suratPermintaanTiketDinas['rute_tujuan_berangkat'] }}
- Tanggal Berangkat : {{ $suratPermintaanTiketDinas['tanggal_berangkat'] }} {{ $suratPermintaanTiketDinas['jam_berangkat'] }}
Kepulangan:
- Rute Asal         : {{ $suratPermintaanTiketDinas['rute_asal_kembali'] }}
- Rute Tujuan       : {{ $suratPermintaanTiketDinas['rute_tujuan_kembali'] }}
- Tanggal Kembali   : {{ $suratPermintaanTiketDinas['tanggal_kembali'] }} {{ $suratPermintaanTiketDinas['jam_kembali'] }}

@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
