@component('mail::message')
# ❌ Penukaran Poin Ditolak

Halo {{ $penukaran->nasabah->name }},

Dengan berat hati kami informasikan bahwa pengajuan penukaran poin Anda kali ini belum dapat kami setujui.

**Berikut adalah rincian transaksinya:**

@component('mail::table')
| Rincian | Informasi |
|:----------------------|:-----------------------------------------------------------------------|
| **ID Transaksi** | `{{ $penukaran->transaction_id }}` |
| **Status** | <span style="color: #dc3545; font-weight: bold;">Ditolak</span> |
| **Hadiah** | {{ $penukaran->hadiah->name }} |
| **Poin Dikembalikan** | {{ number_format($penukaran->points_used) }} Poin |
| **Alasan Penolakan** | {{ $penukaran->notes }} |
@endcomponent

**Informasi Lebih Lanjut:**
Poin Anda tidak akan berkurang dan telah dikembalikan sepenuhnya ke saldo Anda. Jika Anda memiliki pertanyaan lebih
lanjut mengenai alasan penolakan, jangan ragu untuk menghubungi admin kami.

{{-- @if(Auth::user()->hasrole('Operator Padukuhan'))
@component('mail::button', ['url' => route('admin.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@else
@component('mail::button', ['url' => route('nasabah.riwayat-penukaran')])
Lihat Riwayat Penukaran
@endcomponent
@endif --}}

Terima kasih atas pengertian Anda.

Hormat kami,<br>
Tim {{ config('app.name') }}
@endcomponent