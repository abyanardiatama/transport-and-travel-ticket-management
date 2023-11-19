@component('mail::panel')

# Hai 

Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas Anda telah disetujui.

Details:
- Nama Pemohon      : {{ $suratPermintaanTiketDinas['nama_pemohon'] }}
- Unit              : {{ $suratPermintaanTiketDinas['unit'] }}
- Transportasi      : {{ $suratPermintaanTiketDinas['jenis_transportasi'] }} / {{ $suratPermintaanTiketDinas['jenis_kelas'] }}
- Rute              : {{ $suratPermintaanTiketDinas['rute_asal'] }} ke {{ $suratPermintaanTiketDinas['rute_tujuan'] }}
- Rute Kembali      : {{ $suratPermintaanTiketDinas['rute_asal_kembali'] }} ke {{ $suratPermintaanTiketDinas['rute_tujuan_kembali'] }}
- Waktu Berangkat   : {{ $suratPermintaanTiketDinas['tanggal_berangkat'] }}  {{ $suratPermintaanTiketDinas['jam_berangkat'] }}  
- Waktu Kembali     : {{ $suratPermintaanTiketDinas['tanggal_kembali'] }}  {{ $suratPermintaanTiketDinas['jam_kembali'] }}


@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
