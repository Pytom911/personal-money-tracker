@extends('layouts.app')

@section('title', 'Detail Wishlist')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <p class="text-muted-custom mb-2">Wishlist Deposit Detail</p>
                    <h1 class="dashboard-title mb-1">Detail Deposit Wishlist</h1>
                    <p class="text-muted mb-0">Informasi lengkap wishlist dan deposit.</p>
                </div>

                <a href="{{ route('wishlist.index') }}" class="btn-soft d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
            </div>

            @php
                $savedAmount = $wishlistDeposit->wishlist->deposits->sum('amount');

                $progress =
                    $wishlistDeposit->wishlist->target_amount > 0
                        ? ($savedAmount / $wishlistDeposit->wishlist->target_amount) * 100
                        : 0;

                $progress = min($progress, 100);
            @endphp


            {{-- Detail Card --}}

            <div class="dashboard-card overflow-hidden">

                <div class="card-balance-highlight p-4 p-md-5 text-center">
                    @if ($wishlistDeposit->wishlist->image)
                        <img src="{{ asset('storage/' . $wishlistDeposit->wishlist->image) }}"
                            alt="{{ $wishlistDeposit->wishlist->name }}" width="220" height="220"
                            style="object-fit: cover; border-radius: 10px;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light"
                            style="width: 70px; height: 70px; border-radius: 10px;">
                            <i class="bi bi-image text-muted fs-4"></i>
                        </div>
                    @endif
                </div>
            </div>


            <div class="detail-row">
                <span class="detail-label">Name</span>
                <span class="detail-value">{{ $wishlistDeposit->wishlist->name }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Deposit Amount</span>
                <span class="detail-value text-success">+Rp
                    {{ number_format($wishlistDeposit->amount, 0, ',', '.') }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Target Amount</span>
                <span class="detail-value">Rp
                    {{ number_format($wishlistDeposit->wishlist->target_amount, 0, ',', '.') }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Total Saved Amount</span>
                <span class="detail-value">Rp {{ number_format($savedAmount, 0, ',', '.') }}</span>
            </div>

            <div class="progress" style="height: 6px;">
                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"
                    aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <small class="text-muted">
                {{ number_format($progress, 1) }}%
            </small>

            <div class="detail-row">
                <span class="detail-label">Deposit Description</span>
                <span class="detail-value">{{ $wishlistDeposit->description }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Deposit Date</span>
                <span class="detail-value">
                    <i
                        class="bi bi-calendar-event me-2 text-muted"></i>{{ \Carbon\Carbon::parse($wishlistDeposit->deadline)->format('d F Y') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Created At</span>
                <span class="detail-value">{{ $wishlistDeposit->created_at->format('d F Y, H:i') }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Updated At</span>
                <span class="detail-value">{{ $wishlistDeposit->updated_at->format('d F Y, H:i') }}</span>
            </div>


            {{-- Actions --}}

            <div class="d-flex gap-2 pt-4 mt-2">

                <a href="{{ route('wishlistDeposit.edit', $wishlistDeposit) }}" class="btn btn-dark px-4">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit
                </a>

                <form action="{{ route('wishlistDeposit.destroy', $wishlistDeposit) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus wishlist ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger px-4 rounded-3 fw-semibold">
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
