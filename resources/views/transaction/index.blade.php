@extends('layouts.app')

@section('title', 'Transactions')

@section('content')

    {{-- Header --}}

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
        <div>
            <p class="text-muted-custom mb-2">Money Movement</p>
            <h1 class="dashboard-title mb-1">Transactions</h1>
            <p class="text-muted mb-0">Kelola semua transaksi keuangan lu.</p>
        </div>
        <div class="mt-4 mt-md-0">
            <a href="{{ route('transaction.create') }}" class="btn btn-dark">
                <i class="bi bi-plus-circle-fill me-2"></i> Add Transaction
            </a>
        </div>
    </div>


    {{-- Success Message --}}

    @if(session('success'))

        <div class="alert alert-flash-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>

    @endif


    {{-- Transaction Card --}}

    <div class="dashboard-card p-4 p-md-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="card-title-custom mb-1">All Transactions</h5>
                <small class="text-muted">Riwayat lengkap keluar masuk uang</small>
            </div>
            <span class="badge badge-type badge-income">
                {{ $transactions->count() }} Items
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-custom table-hover align-middle">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Type
                        </th>

                        <th>
                            Amount
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Date
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transactions as $transaction)

                        <tr>

                            {{-- ID --}}

                            <td class="text-muted fw-semibold">
                                #{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}
                            </td>


                            {{-- Category --}}

                            <td>

                                <span class="fw-bold text-dark">
                                    {{ $transaction->category->name ?? 'Tanpa Category' }}
                                </span>

                            </td>


                            {{-- Type --}}

                            <td>

                                @if($transaction->type === 'income')

                                    <span class="badge badge-type badge-income">
                                        <i class="bi bi-arrow-down-left me-1"></i> Income
                                    </span>

                                @else

                                    <span class="badge badge-type badge-expense">
                                        <i class="bi bi-arrow-up-right me-1"></i> Expense
                                    </span>

                                @endif

                            </td>


                            {{-- Amount --}}

                            <td>

                                <span
                                    class="fw-bold
                                    {{ $transaction->type === 'income'
                                        ? 'text-success'
                                        : 'text-danger' }}"
                                >

                                    {{ $transaction->type === 'income' ? '+' : '-' }}
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                                </span>

                            </td>


                            {{-- Description --}}

                            <td>

                                <span class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($transaction->description, 40) }}
                                </span>

                            </td>


                            {{-- Date --}}

                            <td>

                                <span class="fw-medium text-dark">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                                </span>

                            </td>


                            {{-- Action --}}

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    {{-- Show --}}

                                    <a
                                        href="{{ route('transaction.show', $transaction) }}"
                                        class="btn-action-icon btn-view"
                                        title="Detail"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>


                                    {{-- Edit --}}

                                    <a
                                        href="{{ route('transaction.edit', $transaction) }}"
                                        class="btn-action-icon btn-edit"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>


                                    {{-- Delete --}}

                                    <form
                                        action="{{ route('transaction.destroy', $transaction) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
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

                            <td colspan="7" class="p-0">

                                <div class="empty-state">

                                    <div class="empty-state-icon">
                                        <i class="bi bi-receipt-cutoff"></i>
                                    </div>

                                    <h5 class="card-title-custom mb-1">Belum ada transaksi</h5>

                                    <p class="text-muted mb-4">
                                        Catat transaksi pertamamu untuk mulai melacak keuangan.
                                    </p>

                                    <a href="{{ route('transaction.create') }}" class="btn btn-dark">
                                        <i class="bi bi-plus-circle-fill me-2"></i> Add Transaction
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
