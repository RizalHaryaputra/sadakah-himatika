@component('mail::message')
# ✅ Penukaran Poin Disetujui

Halo {{ $penukaran->nasabah->name }},

Kabar baik! Pengajuan penukaran poin Anda telah kami setujui. Hadiah Anda sudah disiapkan dan siap untuk diambil.

**Berikut adalah rincian transaksinya:**

@component('mail::table')
| Rincian | Informasi |
|:-------------------|:-------------------------------------------------------------------------|
| **ID Transaksi** | `{{ $penukaran->transaction_id }}` |
| **Status** | <span style="color: #28a745; font-weight: bold;">Disetujui</span> |
| **Hadiah** | {{ $penukaran->hadiah->name }} |
| **Poin Digunakan** | {{ number_format($penukaran->points_used) }} Poin |
| **Tanggal** | {{ $penukaran->approved_at->format('d F Y, H:i') }} WIB |
@endcomponent

**Instruksi Pengambilan Hadiah:**
Silakan datang ke lokasi bank sampah kami untuk mengambil hadiah Anda. Jangan lupa untuk menunjukkan notifikasi email
ini kepada petugas kami sebagai bukti penukaran.

{{-- @if(Auth::user()->hasrole('Operator Padukuhan'))
@component('mail::button', ['url' => route('admin.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@else
@component('mail::button', ['url' => route('nasabah.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@endif --}}

Terima kasih telah menjadi nasabah setia kami.

Hormat kami,<br>
Tim {{ config('app.name') }}
@endcomponent