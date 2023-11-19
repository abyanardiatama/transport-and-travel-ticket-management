@component('mail::panel')

# Hai 

Surat Permintaan Pengurusan Tiket Anda telah dilengkapi.

Details:
- Nama Pemohon      : {{ $suratTiketDinas['nama_pemohon'] }}
- Unit              : {{ $suratTiketDinas['unit'] }}
- Beban Biaya       : {{ $suratTiketDinas['beban_biaya'] }}
Keberangkatan:
- Rute Asal         : {{ $suratTiketDinas['rute_asal_berangkat'] }}
- Rute Tujuan       : {{ $suratTiketDinas['rute_tujuan_berangkat'] }}
- Tanggal Berangkat : {{ $suratTiketDinas['tanggal_berangkat'] }} {{ $suratTiketDinas['jam_berangkat'] }}
Kepulangan:
- Rute Asal         : {{ $suratTiketDinas['rute_asal_kembali'] }}
- Rute Tujuan       : {{ $suratTiketDinas['rute_tujuan_kembali'] }}
- Tanggal Kembali   : {{ $suratTiketDinas['tanggal_kembali'] }} {{ $suratTiketDinas['jam_kembali'] }}

@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
