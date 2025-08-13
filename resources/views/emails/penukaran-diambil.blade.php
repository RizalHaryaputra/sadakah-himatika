@component('mail::message')
# 🎁 Hadiah Berhasil Diambil

Halo {{ $penukaran->nasabah->name }},

Konfirmasi bahwa hadiah dari penukaran poin Anda telah berhasil diambil. Kami harap Anda menyukai hadiahnya!

**Berikut adalah rincian transaksi yang telah selesai:**

@component('mail::table')
| Rincian | Informasi |
|:----------------------|:----------------------------------------------------------------------------|
| **ID Transaksi** | `{{ $penukaran->transaction_id }}` |
| **Status** | <span style="color: #007bff; font-weight: bold;">Selesai (Hadiah Diambil)</span> |
| **Hadiah** | {{ $penukaran->hadiah->name }} |
| **Tanggal Pengambilan** | {{ $penukaran->claimed_at->format('d F Y, H:i') }} WIB |
@endcomponent

Kami sangat menghargai partisipasi Anda dalam program pengelolaan sampah kami. Setiap poin yang Anda kumpulkan sangat
berarti bagi lingkungan.

{{-- @if(Auth::user()->hasrole('Operator Padukuhan'))
@component('mail::button', ['url' => route('admin.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@else
@component('mail::button', ['url' => route('nasabah.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@endif --}}

Sampai jumpa di penukaran berikutnya!

Hormat kami,<br>
Tim {{ config('app.name') }}
@endcomponent