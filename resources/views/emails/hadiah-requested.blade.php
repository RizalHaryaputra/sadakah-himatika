@component('mail::message')
# Pengajuan Hadiah Baru Telah Masuk

Yth. Bapak/Ibu Admin,

Kami informasikan bahwa ada pengajuan penukaran hadiah baru dari nasabah yang membutuhkan perhatian Anda.

**Berikut adalah rincian pengajuannya:**

@component('mail::table')
| Detail              | Informasi                                    |
| :------------------ | :------------------------------------------- |
| **ID Penukaran** | `{{ $penukaran->transaction_id }}`           |
| **Nama Nasabah** | {{ $penukaran->nasabah->name }}              |
| **Hadiah** | {{ $penukaran->hadiah->name }}                |
| **Poin Digunakan** | **{{ number_format($penukaran->points_used) }} Poin** |
| **Tanggal Pengajuan** | {{ $penukaran->requested_at->format('d F Y, H:i') }} WIB |
@endcomponent

Silakan klik tombol di bawah ini untuk melihat detail lengkap dan memproses pengajuan:

@component('mail::button', ['url' => route('admin.penukaran.index')])
Proses Pengajuan Sekarang
@endcomponent

@component('mail::panel')
Segera proses pengajuan ini untuk meningkatkan kepuasan dan loyalitas nasabah.
@endcomponent

Terima kasih,<br>
Tim {{ config('app.name') }}
@endcomponent