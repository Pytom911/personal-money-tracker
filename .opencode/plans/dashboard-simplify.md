# Rencana: Sederhanakan Dashboard

## Ringkasan
Hapus bagian **Cash Flow Analytics** (grafik bar 6 bulan) dan ganti dengan konten lebih simpel tapi padat: **Ringkasan Bulan Ini** + **Top Kategori Pengeluaran (ringkas)**.

## Perubahan

### 1. `resources/views/dashboard.blade.php`
- Hapus baris **121-170** (seksi `<!-- Charts & Spending Section -->` berisi grafik cashflow + spending categories).
- Ganti dengan seksi baru `<!-- This Month Summary & Top Categories -->` dua kolom:
  - **Kiri (`col-lg-8`)**: kartu "Ringkasan Bulan Ini" berisi 3 tile statistik padat (income, expense, net/cash flow bulan ini) dengan ikon & indikator perubahan persen, memakai data `incomeThisMonth`, `expenseThisMonth`, `incomeChange`, `expenseChange`, dan `$netThisMonth = incomeThisMonth - expenseThisMonth`.
  - **Kanan (`col-lg-4`)**: kartu "Top Kategori Pengeluaran" (versi ringkas dari Spending Categories lama) memakai `$spendingByCategory` + `$maxSpending` + gradient.
- Hapus blok `@section('scripts')` (baris **313-387**) beserta link CDN Chart.js, karena grafik sudah tidak dipakai.

### 2. `app/Http/Controllers/DashboardController.php`
- Hapus pemanggilan `$chart = $this->getCashFlowChart();` (baris 74).
- Hapus method `getCashFlowChart()` (baris 101-127).
- Hapus `'chart'` dari `compact()` (baris 89).
- Tidak perlu data baru — semua variabel untuk konten pengganti sudah tersedia.

## Catatan style
- Reuse kelas CSS yang sudah ada (`dashboard-card`, `card-title-custom`, `summary-card`, `summary-icon`, `icon-income`, `icon-expense`, `progress`, `bg-gradient-*`).
- Beberapa inline style kecil untuk ukuran ikon yang lebih ramping.
- Tidak perlu file CSS baru.

## Verifikasi
- Jalankan `php artisan view:clear`.
- Muat route dashboard di browser untuk memastikan halaman render tanpa error dan tidak ada referensi JS yang rusak.

## File yang diubah
- `resources/views/dashboard.blade.php`
- `app/Http/Controllers/DashboardController.php`
