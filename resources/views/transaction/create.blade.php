@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="mb-5">
                <p class="text-muted-custom mb-2">New Entry</p>
                <h1 class="dashboard-title mb-1">Add Transaction</h1>
                <p class="text-muted mb-0">Catat pemasukan atau pengeluaran barumu.</p>
            </div>


            {{-- Back Link (Mobile) --}}

            <a href="{{ route('transaction.index') }}" class="btn-soft d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>


            {{-- Form Card --}}

            <div class="dashboard-card p-4 p-md-5">

                @if($errors->any())

                    <div class="alert alert-flash-danger mb-4">

                        <strong>
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Ada beberapa kesalahan:
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <form
                    action="{{ route('transaction.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- Type --}}

                    <div class="mb-4">

                        <label class="form-label">
                            Type
                        </label>

                        <div class="segmented-control">

                            <input
                                type="radio"
                                name="type"
                                id="type_income"
                                value="income"
                                {{ old('type') === 'income' ? 'checked' : '' }}
                                required
                            >

                            <label class="segmented-option" for="type_income">
                                <i class="bi bi-arrow-down-left"></i> Income
                            </label>

                            <input
                                type="radio"
                                name="type"
                                id="type_expense"
                                value="expense"
                                {{ old('type') !== 'income' && old('type') === 'expense' ? 'checked' : '' }}
                            >

                            <label class="segmented-option" for="type_expense">
                                <i class="bi bi-arrow-up-right"></i> Expense
                            </label>

                        </div>

                        @error('type')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Amount --}}

                    <div class="mb-3">

                        <label
                            for="amount"
                            class="form-label"
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
                                value="{{ old('amount') }}"
                                placeholder="Contoh: 50000"
                                min="0"
                                required
                            >

                        </div>

                        @error('amount')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Category --}}

                    <div class="mb-3">

                        <label
                            for="category_id"
                            class="form-label"
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
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }} ({{ ucfirst($category->type) }})
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Transaction Date --}}

                    <div class="mb-3">

                        <label
                            for="transaction_date"
                            class="form-label"
                        >
                            Transaction Date
                        </label>

                        <input
                            type="date"
                            id="transaction_date"
                            name="transaction_date"
                            class="form-control @error('transaction_date') is-invalid @enderror"
                            value="{{ old('transaction_date', date('Y-m-d')) }}"
                            required
                        >

                        @error('transaction_date')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="mb-4">

                        <label
                            for="description"
                            class="form-label"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            rows="3"
                            placeholder="Contoh: Makan siang"
                            required
                        >{{ old('description') }}</textarea>

                        @error('description')

                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Action --}}

                    <div class="d-flex gap-2 pt-2">

                        <a
                            href="{{ route('transaction.index') }}"
                            class="btn btn-soft px-4"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-dark px-4"
                        >
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Simpan Transaksi
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
