@component('mail::panel')

# Hai 

Anda memiliki Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas baru yang perlu disetujui.

Details:
- Nama Pemohon      : {{ $validatedData['nama_pemohon'] }}
- Unit              : {{ $validatedData['unit'] }}
Keberangkatan:
- Rute Asal         : {{ $validatedData['rute_asal_berangkat'] }}
- Rute Tujuan       : {{ $validatedData['rute_tujuan_berangkat'] }}
- Tanggal Berangkat : {{ $validatedData['tanggal_berangkat'] }} {{ $validatedData['jam_berangkat'] }}
Kepulangan:
- Rute Asal         : {{ $validatedData['rute_asal_kembali'] }}
- Rute Tujuan       : {{ $validatedData['rute_tujuan_kembali'] }}
- Tanggal Kembali   : {{ $validatedData['tanggal_kembali'] }} {{ $validatedData['jam_kembali'] }}

@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
