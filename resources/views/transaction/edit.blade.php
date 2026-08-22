<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Transaksi</title>

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

                <div class="mb-4">

                    <h1 class="fw-bold mb-1">
                        Edit Transaksi
                    </h1>

                    <p class="text-muted mb-0">
                        Perbarui informasi transaksi.
                    </p>

                </div>

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        @if($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Ada beberapa kesalahan:
                                </strong>

                                <ul class="mb-0 mt-2">

                                    @foreach($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            action="{{ route('transaction.update', $transaction) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PUT')


                            {{-- Category --}}

                            <div class="mb-3">

                                <label
                                    for="category_id"
                                    class="form-label fw-semibold"
                                >
                                    Category
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Pilih category
                                    </option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('category_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Type --}}

                            <div class="mb-3">

                                <label
                                    for="type"
                                    class="form-label fw-semibold"
                                >
                                    Type
                                </label>

                                <select
                                    id="type"
                                    name="type"
                                    class="form-select @error('type') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Pilih type
                                    </option>

                                    <option
                                        value="income"
                                        {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}
                                    >
                                        Income
                                    </option>

                                    <option
                                        value="expense"
                                        {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}
                                    >
                                        Expense
                                    </option>

                                </select>

                                @error('type')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Amount --}}

                            <div class="mb-3">

                                <label
                                    for="amount"
                                    class="form-label fw-semibold"
                                >
                                    Amount
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        id="amount"
                                        name="amount"
                                        class="form-control @error('amount') is-invalid @enderror"
                                        value="{{ old('amount', $transaction->amount) }}"
                                        min="0"
                                        required
                                    >

                                </div>

                                @error('amount')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Description --}}

                            <div class="mb-3">

                                <label
                                    for="description"
                                    class="form-label fw-semibold"
                                >
                                    Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="3"
                                    required
                                >{{ old('description', $transaction->description) }}</textarea>

                                @error('description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Transaction Date --}}

                            <div class="mb-4">

                                <label
                                    for="transaction_date"
                                    class="form-label fw-semibold"
                                >
                                    Transaction Date
                                </label>

                                <input
                                    type="date"
                                    id="transaction_date"
                                    name="transaction_date"
                                    class="form-control @error('transaction_date') is-invalid @enderror"
                                    value="{{ old('transaction_date', $transaction->transaction_date) }}"
                                    required
                                >

                                @error('transaction_date')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Action --}}

                            <div class="d-flex gap-2">

                                <a
                                    href="{{ route('transaction.index') }}"
                                    class="btn btn-light border"
                                >
                                    Batal
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    <i class="bi bi-save me-1"></i>
                                    Simpan Perubahan
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
