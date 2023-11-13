@component('mail::panel')

# Hai 

Surat Perintah Kerja Anda telah dibuat.

Details:
- Tujuan            : {{ $data['alamat'] }}
- Keperluan         : {{ $data['keperluan'] }}
- Kendaraan         : {{ $data['nomor_polisi'] }}
- Tanggal Berangkat : {{ $data['tanggal_berangkat'] }}  {{ $data['jam_berangkat'] }}
- Tanggal Kembali   : {{ $data['tanggal_kembali'] }}  {{ $data['jam_kembali'] }}
- Lama Perjalanan   : {{ $data['lama_perjalanan'] }} Hari


@component('mail::button', ['url' => url('/dashboard')])
View Surat Perintah Kerja
@endcomponent


Thanks,
System Application
@endcomponent
