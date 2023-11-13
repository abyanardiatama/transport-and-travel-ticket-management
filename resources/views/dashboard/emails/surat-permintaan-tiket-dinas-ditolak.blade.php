@component('mail::panel')

# Hai 

Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas Anda ditolak.

Details:
- Nama Pemohon      : {{ $suratPermintaanTiketDinas['nama_pemohon'] }}
- Unit              : {{ $suratPermintaanTiketDinas['unit'] }}
- Beban Biaya       : {{ $suratPermintaanTiketDinas['beban_biaya'] }}
- Transportasi      : {{ $suratPermintaanTiketDinas['jenis_transportasi'] }} / {{ $suratPermintaanTiketDinas['jenis_kelas'] }}
- Rute              : {{ $suratPermintaanTiketDinas['rute_asal'] }} ke {{ $suratPermintaanTiketDinas['rute_tujuan'] }}
- Tanggal Berangkat : {{ $suratPermintaanTiketDinas['tanggal_berangkat'] }}  {{ $suratPermintaanTiketDinas['jam_berangkat'] }}  


@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
