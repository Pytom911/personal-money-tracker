@extends('layouts.app')

@section('title', 'Tambah Deposit')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-9 col-lg-7 col-xl-6">

            {{-- Header --}}

            <div class="mb-5">
                <p class="text-muted-custom mb-2">New Tag</p>
                <h1 class="dashboard-title mb-1">Add Deposit</h1>
                <p class="text-muted mb-0">Tambahkan Deposit baru ke finance tracker.</p>
            </div>


            {{-- Back Link (Mobile) --}}

            <a href="{{ route('wishlistDeposit.index') }}" class="btn-soft d-inline-flex align-items-center gap-2 mb-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>


            {{-- Form Card --}}

            <div class="dashboard-card p-4 p-md-5">

                @if ($errors->any())

                    <div class="alert alert-flash-danger mb-4">

                        <strong>
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Ada beberapa kesalahan:
                        </strong>

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif
                <form action="{{ route('wishlistDeposit.store') }}" method="POST">
                    @csrf


                    {{-- ID Wishlist --}}

                    <div class="mb-4">

                        <label for="wishlist_id" class="form-label">
                            Wishlist Name
                        </label>

                        <select id="wishlist_id" name="wishlist_id"
                            class="form-select @error('wishlist_id') is-invalid @enderror" required>
                            <option value="">Pilih Wishlist</option>

                            @foreach ($wishlists as $wishlist)
                                <option value="{{ $wishlist->id }}"
                                    {{ old('wishlist_id') == $wishlist->id ? 'selected' : '' }}>
                                    {{ $wishlist->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('wishlist_id')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Amount --}}

                    <div class="mb-3">

                        <label for="amount" class="form-label">
                            Deposit Amount
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input type="number" id="amount" name="amount"
                                class="form-control @error('amount') is-invalid @enderror"
                                value="{{ old('amount') }}" placeholder="Contoh: 50000" min="0" required>

                        </div>

                        @error('amount')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Description --}}
                    <div class="mb-4">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3" placeholder="Contoh: Sisa uang saku" required>{{ old('description') }}</textarea>

                        @error('description')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- Deposit Date --}}
                    <div class="mb-4">

                        <label for="deposit_date" class="form-label">
                            Deposit Date
                        </label>

                        <input type="date" id="deposit_date" name="deposit_date"
                            class="form-control @error('deposit_date') is-invalid @enderror"
                            value="{{ old('deposit_date', date('Y-m-d')) }}" required>{{ old('deposit_date') }}</input>

                        @error('deposit_date')
                            <div class="text-danger small mt-2 fw-medium">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Action --}}

                    <div class="d-flex gap-2 pt-2">

                        <a href="{{ route('categories.index') }}" class="btn btn-soft px-4">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-dark px-4">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Simpan Category
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
