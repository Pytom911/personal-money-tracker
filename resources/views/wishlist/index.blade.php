@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <p class="text-muted-custom mb-2">Wishlist</p>
            <h1 class="dashboard-title mb-1">Wishlist</h1>
            <p class="text-muted mb-0">Kelola semua wishlist kamu di sini.</p>
        </div>

        <div class="mt-4 mt-md-0">
            <a href="{{ route('wishlist.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle-fill me-2"></i>
                Add Wishlist
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-flash-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Wishlist Card --}}
    <div class="dashboard-card p-4 p-md-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="card-title-custom mb-1">All Wishlist</h5>
                <small class="text-muted">
                    Semua target barang yang sedang kamu tabung.
                </small>
            </div>

            <span class="badge badge-type badge-income">
                {{ $wishlists->count() }} Items
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-custom table-hover align-middle">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Target Amount</th>
                        <th>Saved Amount</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($wishlists as $wishlist)

                        @php
                            $savedAmount = $wishlist->deposits->sum('amount');

                            $progress = $wishlist->target_amount > 0
                                ? ($savedAmount / $wishlist->target_amount) * 100
                                : 0;

                            $progress = min($progress, 100);
                        @endphp

                        <tr>

                            {{-- ID --}}
                            <td class="text-muted fw-semibold">
                                #{{ str_pad($wishlist->id, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Name --}}
                            <td>
                                <span class="fw-bold text-dark">
                                    {{ $wishlist->name }}
                                </span>
                            </td>

                            {{-- Image --}}
                            <td>
                                @if ($wishlist->image)
                                    <img
                                        src="{{ asset('storage/' . $wishlist->image) }}"
                                        alt="{{ $wishlist->name }}"
                                        width="70"
                                        height="70"
                                        style="object-fit: cover; border-radius: 10px;"
                                    >
                                @else
                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light"
                                        style="width: 70px; height: 70px; border-radius: 10px;"
                                    >
                                        <i class="bi bi-image text-muted fs-4"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Target Amount --}}
                            <td>
                                <span class="fw-bold">
                                    Rp {{ number_format($wishlist->target_amount, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Saved Amount --}}
                            <td>
                                <div class="mb-1">
                                    <span class="fw-bold">
                                        Rp {{ number_format($savedAmount, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="progress" style="height: 6px;">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ $progress }}%;"
                                        aria-valuenow="{{ $progress }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    ></div>
                                </div>

                                <small class="text-muted">
                                    {{ number_format($progress, 1) }}%
                                </small>
                            </td>

                            {{-- Description --}}
                            <td>
                                <span class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($wishlist->description, 40) }}
                                </span>
                            </td>

                            {{-- Deadline --}}
                            <td>
                                <span class="fw-medium text-dark">
                                    {{ \Carbon\Carbon::parse($wishlist->deadline)->format('d M Y') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if ($wishlist->status === 'active')
                                    <span class="badge bg-primary">
                                        Active
                                    </span>
                                @elseif ($wishlist->status === 'completed')
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                @elseif ($wishlist->status === 'cancelled')
                                    <span class="badge bg-secondary">
                                        Cancelled
                                    </span>
                                @endif
                            </td>

                            {{-- Action --}}
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-2">

                                    {{-- Show --}}
                                    <a
                                        href="{{ route('wishlist.show', $wishlist) }}"
                                        class="btn-action-icon btn-view"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('wishlist.edit', $wishlist) }}"
                                        class="btn-action-icon btn-edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('wishlist.destroy', $wishlist) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus wishlist ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action-icon btn-delete border"
                                            title="Hapus"
                                        >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="p-0">
                                <div class="empty-state">

                                    <div class="empty-state-icon">
                                        <i class="bi bi-heart"></i>
                                    </div>

                                    <h5 class="card-title-custom mb-1">
                                        Belum ada wishlist
                                    </h5>

                                    <p class="text-muted mb-4">
                                        Tambahkan wishlist pertamamu untuk mulai menabung.
                                    </p>

                                    <a
                                        href="{{ route('wishlist.create') }}"
                                        class="btn btn-dark"
                                    >
                                        <i class="bi bi-plus-circle-fill me-2"></i>
                                        Add Wishlist
                                    </a>

                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

@endsection
