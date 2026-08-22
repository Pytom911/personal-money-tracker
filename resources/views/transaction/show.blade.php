<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Transaksi</title>

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

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-7">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h1 class="fw-bold mb-1">
                            Detail Transaksi
                        </h1>

                        <p class="text-muted mb-0">
                            Informasi lengkap transaksi.
                        </p>

                    </div>

                    <a
                        href="{{ route('transaction.index') }}"
                        class="btn btn-light border"
                    >
                        Kembali
                    </a>

                </div>


                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">


                        {{-- Amount --}}

                        <div class="text-center mb-4">

                            @if($transaction->type === 'income')

                                <div class="text-success mb-2">
                                    <i class="bi bi-arrow-down-left-circle fs-1"></i>
                                </div>

                                <small class="text-muted">
                                    Income
                                </small>

                                <h2 class="fw-bold text-success">
                                    + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </h2>

                            @else

                                <div class="text-danger mb-2">
                                    <i class="bi bi-arrow-up-right-circle fs-1"></i>
                                </div>

                                <small class="text-muted">
                                    Expense
                                </small>

                                <h2 class="fw-bold text-danger">
                                    - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </h2>

                            @endif

                        </div>


                        <hr>


                        {{-- Category --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Category
                            </small>

                            <div class="fw-semibold">
                                {{ $transaction->category->name }}
                            </div>

                        </div>


                        {{-- Type --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Type
                            </small>

                            @if($transaction->type === 'income')

                                <span class="badge text-bg-success">
                                    Income
                                </span>

                            @else

                                <span class="badge text-bg-danger">
                                    Expense
                                </span>

                            @endif

                        </div>


                        {{-- Description --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Description
                            </small>

                            <div>
                                {{ $transaction->description }}
                            </div>

                        </div>


                        {{-- Date --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Transaction Date
                            </small>

                            <div>
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d F Y') }}
                            </div>

                        </div>


                        {{-- Created At --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Created At
                            </small>

                            <div>
                                {{ $transaction->created_at->format('d F Y, H:i') }}
                            </div>

                        </div>


                        {{-- Updated At --}}

                        <div class="py-3">

                            <small class="text-muted d-block mb-1">
                                Updated At
                            </small>

                            <div>
                                {{ $transaction->updated_at->format('d F Y, H:i') }}
                            </div>

                        </div>


                        <hr>


                        {{-- Actions --}}

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('transaction.edit', $transaction) }}"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-pencil me-1"></i>
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
                                    class="btn btn-outline-danger"
                                >
                                    <i class="bi bi-trash me-1"></i>
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
