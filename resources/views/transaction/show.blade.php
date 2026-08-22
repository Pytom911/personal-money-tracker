@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <p class="text-muted-custom mb-2">Transaction Detail</p>
                    <h1 class="dashboard-title mb-1">Detail Transaksi</h1>
                    <p class="text-muted mb-0">Informasi lengkap transaksi.</p>
                </div>

                <a
                    href="{{ route('transaction.index') }}"
                    class="btn-soft d-inline-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
            </div>


            {{-- Detail Card --}}

            <div class="dashboard-card overflow-hidden">

                {{-- Amount Highlight --}}

                @if($transaction->type === 'income')

                    <div class="card-balance-highlight p-4 p-md-5 text-center">
                        <div class="summary-icon transaction-income mx-auto mb-3 shadow-sm">
                            <i class="bi bi-arrow-down-left"></i>
                        </div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="letter-spacing: 1px;">
                            Income
                        </small>
                        <div class="summary-value">
                            + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </div>
                        <span class="badge badge-type badge-income mt-3">
                            {{ $transaction->category->name ?? 'Tanpa Category' }}
                        </span>
                    </div>

                @else

                    <div class="card-balance-highlight p-4 p-md-5 text-center" style="background: linear-gradient(135deg, #7f1d1d 0%, #ef4444 100%);">
                        <div class="summary-icon transaction-expense mx-auto mb-3 shadow-sm">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                        <small class="text-white-50 text-uppercase fw-semibold" style="letter-spacing: 1px;">
                            Expense
                        </small>
                        <div class="summary-value">
                            - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </div>
                        <span class="badge badge-type badge-expense mt-3">
                            {{ $transaction->category->name ?? 'Tanpa Category' }}
                        </span>
                    </div>

                @endif


                {{-- Info Rows --}}

                <div class="p-4 p-md-5">

                    <div class="detail-row">
                        <span class="detail-label">Type</span>

                        @if($transaction->type === 'income')
                            <span class="badge badge-type badge-income">
                                <i class="bi bi-arrow-down-left me-1"></i> Income
                            </span>
                        @else
                            <span class="badge badge-type badge-expense">
                                <i class="bi bi-arrow-up-right me-1"></i> Expense
                            </span>
                        @endif
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Description</span>
                        <span class="detail-value">{{ $transaction->description }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Transaction Date</span>
                        <span class="detail-value">
                            <i class="bi bi-calendar-event me-2 text-muted"></i>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d F Y') }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Created At</span>
                        <span class="detail-value">{{ $transaction->created_at->format('d F Y, H:i') }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Updated At</span>
                        <span class="detail-value">{{ $transaction->updated_at->format('d F Y, H:i') }}</span>
                    </div>


                    {{-- Actions --}}

                    <div class="d-flex gap-2 pt-4 mt-2">

                        <a
                            href="{{ route('transaction.edit', $transaction) }}"
                            class="btn btn-dark px-4"
                        >
                            <i class="bi bi-pencil-square me-2"></i>
                            Edit
                        </a>

                        <form
                            action="{{ route('transaction.destroy', $transaction) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-outline-danger px-4 rounded-3 fw-semibold"
                            >
                                <i class="bi bi-trash me-2"></i>
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
