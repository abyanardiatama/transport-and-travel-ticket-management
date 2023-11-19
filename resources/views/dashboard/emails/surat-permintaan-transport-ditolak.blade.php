@component('mail::panel')

# Hai 

Surat Permintaan Transport Anda telah ditolak.

Details:
- Nama Pemohon      : {{ $data['nama_pemohon'] }}
- Unit              : {{ $data['unit'] }}
- Tujuan            : {{ $data['tujuan'] }}
- Keperluan         : {{ $data['keperluan'] }}
- Tanggal Berangkat : {{ $data['tanggal_berangkat'] }}  {{ $data['jam_berangkat'] }}
- Tanggal Kembali   : {{ $data['tanggal_kembali'] }}  {{ $data['jam_kembali'] }}


@component('mail::button', ['url' => url('/dashboard/permintaantransport/')])
View Surat Permintaan Transport
@endcomponent


Thanks,
System Application
@endcomponent
