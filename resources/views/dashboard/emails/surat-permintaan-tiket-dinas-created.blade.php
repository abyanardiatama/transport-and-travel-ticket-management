@component('mail::panel')

# Hai 

Anda memiliki Surat Permintaan Pengurusan Tiket untuk Perjalanan Dinas baru yang perlu disetujui.

Details:
- Nama Pemohon      : {{ $validatedData['nama_pemohon'] }}
- Unit              : {{ $validatedData['unit'] }}
- Beban Biaya       : {{ $validatedData['beban_biaya'] }}
- Transportasi      : {{ $validatedData['jenis_transportasi'] }} / {{ $validatedData['jenis_kelas'] }}
- Rute              : {{ $validatedData['rute_asal'] }} ke {{ $validatedData['rute_tujuan'] }}
- Tanggal Berangkat : {{ $validatedData['tanggal_berangkat'] }}  {{ $validatedData['jam_berangkat'] }}  


@component('mail::button', ['url' => url('/dashboard/permintaantiketdinas/')])
View Surat Permintaan
@endcomponent

Thanks,
System Application
@endcomponent
