@component('mail::panel')

# Hai 

Surat Permintaan Transport Anda telah dilengkapi.

Details:
- Nama Pemohon      : {{ $validatedData['nama_pemohon'] }}
- Unit              : {{ $validatedData['unit'] }}
- Tujuan            : {{ $validatedData['tujuan'] }}
- Keperluan         : {{ $validatedData['keperluan'] }}
- Tanggal Berangkat : {{ $validatedData['tanggal_berangkat'] }}  {{ $validatedData['jam_berangkat'] }}
- Tanggal Kembali   : {{ $validatedData['tanggal_kembali'] }}  {{ $validatedData['jam_kembali'] }}
- Nama Driver       : {{ $validatedData['nama_driver'] }}
- Nama Kendaraan    : {{ $validatedData['nomor_polisi'] }}


@component('mail::button', ['url' => url('/dashboard/permintaantransport/')])
View Surat Permintaan Transport
@endcomponent


Thanks,
System Application
@endcomponent
