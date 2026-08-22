<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transactions</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
</head>

<body class="bg-light">

    <div class="container py-5">

        {{-- Header --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-bold mb-1">
                    Transactions
                </h1>

                <p class="text-muted mb-0">
                    Kelola semua transaksi keuangan lu.
                </p>
            </div>

            <a
                href="{{ route('transaction.create') }}"
                class="btn btn-primary"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Transaksi
            </a>

        </div>


        {{-- Success Message --}}

        @if(session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>

        @endif


        {{-- Transaction Card --}}

        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="px-4 py-3">
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

                                <th class="text-end px-4">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($transactions as $transaction)

                                <tr>

                                    {{-- ID --}}

                                    <td class="px-4">
                                        {{ $transaction->id }}
                                    </td>


                                    {{-- Category --}}

                                    <td>

                                        <span class="fw-semibold">
                                            {{ $transaction->category->name ?? 'Tanpa Category' }}
                                        </span>

                                    </td>


                                    {{-- Type --}}

                                    <td>

                                        @if($transaction->type === 'income')

                                            <span class="badge text-bg-success">
                                                <i class="bi bi-arrow-down-left me-1"></i>
                                                Income
                                            </span>

                                        @else

                                            <span class="badge text-bg-danger">
                                                <i class="bi bi-arrow-up-right me-1"></i>
                                                Expense
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Amount --}}

                                    <td>

                                        <span
                                            class="fw-semibold
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
                                            {{ $transaction->description }}
                                        </span>

                                    </td>


                                    {{-- Date --}}

                                    <td>

                                        {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}

                                    </td>


                                    {{-- Action --}}

                                    <td class="text-end px-4">

                                        <div class="d-flex justify-content-end gap-1">

                                            {{-- Show --}}

                                            <a
                                                href="{{ route('transaction.show', $transaction) }}"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Detail"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- Edit --}}

                                            <a
                                                href="{{ route('transaction.edit', $transaction) }}"
                                                class="btn btn-sm btn-outline-primary"
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
                                                    class="btn btn-sm btn-outline-danger"
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

                                    <td
                                        colspan="7"
                                        class="text-center py-5"
                                    >

                                        <div class="text-muted">

                                            <i class="bi bi-receipt fs-1 d-block mb-3"></i>

                                            <h5 class="fw-semibold">
                                                Belum ada transaksi
                                            </h5>

                                            <p class="mb-3">
                                                Lu belum memiliki transaksi.
                                            </p>

                                            <a
                                                href="{{ route('transaction.create') }}"
                                                class="btn btn-primary"
                                            >
                                                <i class="bi bi-plus-lg me-1"></i>
                                                Tambah Transaksi
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>
