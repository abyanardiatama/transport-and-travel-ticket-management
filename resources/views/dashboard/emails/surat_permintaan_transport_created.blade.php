@component('mail::panel')

# Hai 

Anda memiliki Surat Permintaan Transport baru yang perlu disetujui.

Details:
- Nama Pemohon      : {{ $validatedData['nama_pemohon'] }}
- Unit              : {{ $validatedData['unit'] }}
- Tujua             : {{ $validatedData['tujuan'] }}
- Keperluan         : {{ $validatedData['keperluan'] }}
- Tanggal Berangkat : {{ $validatedData['tanggal_berangkat'] }}  {{ $validatedData['jam_berangkat'] }}
- Tanggal Kembali   : {{ $validatedData['tanggal_kembali'] }}  {{ $validatedData['jam_kembali'] }}


@component('mail::button', ['url' => url('/dashboard/permintaantransport/')])
View Surat Permintaan Transport
@endcomponent


Thanks,
System Application
@endcomponent
